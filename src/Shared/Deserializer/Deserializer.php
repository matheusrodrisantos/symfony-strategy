<?php
namespace App\Shared\Deserializer;

use ReflectionClass;
use ReflectionProperty;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ConstraintViolationList;
use DateTime;
use Exception;

class Deserializer
{
    private ValidatorInterface $validator;

    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    public function deserialize(string $json, string $className): object
    {
        $data = json_decode($json, true);

        foreach ($data as $propertyName => $value) {
            if ($this->isDateTimeProperty($className, $propertyName) && is_string($value)) {
                try {
                    $data[$propertyName] = new DateTime($value);
                } catch (Exception $e) {
                    throw new \Exception("Erro ao converter a data para o formato DateTime.");
                }
            }
        }

        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();
        $params = $constructor ? $constructor->getParameters() : [];

        $args = [];
        foreach ($params as $param) {
            $paramName = $param->getName();
            $args[] = $data[$paramName] ?? null;
        }

        $object = $reflectionClass->newInstanceArgs($args);

        $violations = new ConstraintViolationList();

        $violations = $this->validator->validate($object);

        if (count($violations) > 0) {
            $errors = '';
            foreach ($violations as $violation) {
                $errors .= "property: " . $violation->getPropertyPath() . 
                        " message: " . $violation->getMessage() . " \n";
            }
            throw new \Exception("Erros de validação encontrados: " . $errors);
        }

        return $object;
    }

    private function isDateTimeProperty(string $className, string $propertyName): bool
    {
        $reflection = new ReflectionClass($className);
        $property = $reflection->getProperty($propertyName);
        $type = $property->getType();

        return $type && $type->getName() === 'DateTimeInterface';
    }
}
