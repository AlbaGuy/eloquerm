<?php
/**
 * This file is part of the Eloquerm.
 *
 * (©) Ermal Xhaka <ermal1091@gmail.com>
 *
 * This source file is subject to the AGPL-3.0 license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Eloquerm\Model;

use Eloquerm\Database\Query\Builder;
use PDOException;
use ReflectionClass;
use ReflectionProperty;
use Eloquerm\Model\Metadata;
use Attribute;

abstract class Model
{
    protected static $table;
    protected static $primaryKey = 'id';
    protected $attributes = [];
    protected $fillable = [];
    protected $guarded = [];

    public function __construct($attributes = [])
    {  
        $this->initializeAttributes($attributes);
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->attributes)) {
            return $this->attributes[$name];
        }

        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }


    public function set($name, $value)
    {
        // Set the value in the $attributes array
        $this->attributes[$name] = $value;
        // If the property exists on the object, set it as well
        if (property_exists($this, $name)) {
            $this->$name = $value;
        }
        // Return the object for potential method chaining
        return $this;
    }

    public function setTable($value='')
    {
        // Set table name
        self::$table = $value;
        return $this;
    }

    public function setPrimaryKey($value='')
    {
        // Set table name
        self::$primaryKey = $value;
        return $this;
    }

    public static function getAll()
    {
        return self::query()->getAll();
    }

    public static function getById($id=NULL)
    {
        return self::query()->getById($id);
    }

    public static function where($column, $operator, $value)
    {
        return self::query()->where($column, $operator, $value);
    }

    public function save()
    {
        if (isset($this->attributes[static::$primaryKey])) {
            return $this->update();
        } else {
            return $this->insert();
        }
      
    }

    public function insert()
    {
        $this->attributes[static::$primaryKey] = self::query()->insert($this->attributes);
        return $this->attributes[static::$primaryKey];
    }

    public function update()
    {
        return self::query()->update($this->attributes, [static::$primaryKey => $this->attributes[static::$primaryKey]]);
    }

    public function delete($id=NULL)
    {   
        $id = $id!= null?$id:($this->attributes[static::$primaryKey]??null);
        return self::query()->delete([static::$primaryKey => $id]);
    }

    /**
     * Only the fields marked as fillable are used in the mass assignment
     * @param  string  $key
     * @return boolean
     */
    private function isFillable($key)
    {
        return in_array($key, $this->fillable) || empty($this->fillable);
    }

    /**
     * Method return if attribute that isn't mass assignable
     */
    /**
     * @param  [type]  $key
     * @return boolean
     */
    private function isGuarded($key)
    {
        return in_array($key, $this->guarded);
    }
    

    /**
     * Method to initialize attributes dynamically
     */

    private function initializeAttributes($attributes)
    {   
        /**
         * Iterates over the object's attributes and assigns corresponding values 
         * $key is the key of attributes
         * @var string
         */
        foreach ($attributes as $key => $attribute) {
            if ($this->isFillable($key) && !$this->isGuarded($key)) {
                $this->attributes[$key] = $attribute;
                $this->$key = $attribute;
            }
        }
        /**
         * Retrieve class attribute metadata.
         * @var ReflectionClass
         */
        $reflection = new ReflectionClass($this);
        $properties = $reflection->getProperties(ReflectionProperty::IS_PROTECTED);
        /**
         * loop the metadata
         */
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $attributesMetadata = $property->getAttributes(Metadata::class);

            if (!empty($attributesMetadata)) {
                $metadataInstance = $attributesMetadata[0]->newInstance();
                $dbColumnName = $metadataInstance->name;
                /**
                 * If there is no attribute in the class, I create the mapping in the attributes array, 
                 * otherwise I set the attribute to the value of the attributes array.
                 */            
                if(!isset($this->attributes[$dbColumnName]))
                    $this->attributes[$dbColumnName] = $this->$propertyName;
                else
                    $this->$propertyName =   $this->attributes[$dbColumnName];
                //remove class attribute from attributes array(DB values only)
                unset($this->attributes[$propertyName]);
            }
        } 
    }

    public static function printPropertyMetadata(string $className = '')
    {
        if (empty($className)) {
            $className = static::class;
        }

        $reflectionClass = new ReflectionClass($className);

        foreach ($reflectionClass->getProperties() as $property) {
            $attributes = $property->getAttributes(Metadata::class);

            foreach ($attributes as $attribute) {
                $metadata = $attribute->newInstance();

                // Stampa il nome della proprietà
                echo "Property: {$property->getName()}</br>";

                // Stampa i metadati usando la riflessione
                foreach (get_object_vars($metadata) as $key => $value) {
                    echo ucfirst($key) . ": $value</br>";
                }

                echo "----------</br>";
            }
        }
    }

    public static function query()
    {
        return (new Builder(static::class,static::$primaryKey))->table(static::$table);
    }

    public static function toObject(array $data)
    {
        return new static($data);
    }
}

#[Attribute]
class Metadata
{
    public function __construct(
        public string $name='',
        public string $type='string',
        public string $description=''
    ) {}
}