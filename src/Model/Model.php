<?php
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

    public function __construct($attributes = [])
    {
        $this->attributes = $attributes;    
        $this->initializeAttributes();
    }

    /**
     * Method to initialize attributes dynamically
     */

     private function initializeAttributes()
    {   
        /**
         * Itera sugli attributi dell'oggetto e assegna i valori corrispondenti
         * se la proprietà esiste nell'oggetto corrente.
         * $key is the key of attributes
         * @var string
         */
        foreach ($this->attributes as $key => $attribute) {
            if(isset($this->$key)){
                $this->$key = $attribute;
            }
        }
        /**
         * Recupero i metadata degli attributi della classe.
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
                 * Se non esiste un attributo nella classe, creo la mappatura nell array
                 * attributes, altrimenti all attributo setto il valore dell array attributes.
                 */            
                if(!isset($this->attributes[$dbColumnName]))
                    $this->attributes[$dbColumnName] = $this->$propertyName;
                else
                    $this->$propertyName =   $this->attributes[$dbColumnName];
                //rimuovo l attributo della classe dall array attributes(solo valori del DB)
                unset($this->attributes[$propertyName]);
            }
        }
    }



    function printPropertyMetadata(string $className = ''){
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


    public static function getAll()
    {
        return (new Builder(static::class,static::$primaryKey))->table(static::$table)->getAll();
    }

    public static function getById($id=NULL)
    {
        return (new Builder(static::class,static::$primaryKey))->table(static::$table)->getById($id);
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
        $query = (new Builder(static::class,static::$primaryKey))->table(static::$table);
        $this->attributes[static::$primaryKey] = $query->insert($this->attributes);
        return $this->attributes[static::$primaryKey];
    }

    public function update()
    {
        $query = (new Builder(static::class,static::$primaryKey))->table(static::$table);
        return $query->update($this->attributes, [static::$primaryKey => $this->attributes[static::$primaryKey]]);
    }

    public function delete($id=NULL)
    {   
        $id = $id!= null?$id:($this->attributes[static::$primaryKey]??null);
            $query = (new Builder(static::class,static::$primaryKey))->table(static::$table);
        return $query->delete([static::$primaryKey => $id]);
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