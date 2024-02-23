<?php namespace App\State;
// https://api-platform.com/docs/core/state-processors/
use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserStateProcessor implements ProcessorInterface {
 private $passwordHasher;
 private $decorated;
 public function __construct(private ProcessorInterface $persistProcessor,
UserPasswordHasherInterface $passwordHasher) {
 $this->passwordHasher = $passwordHasher;
 }
 public function process($data, Operation $operation, array $uriVariables = [], array $context =
[])
 {
 // call your persistence layer to save $data
 if ($data->getPassword()) {
 $data->setPassword(
 $this->passwordHasher->hashPassword($data, $data->getPassword())
 );
 }
 $result = $this->persistProcessor->process($data, $operation, $uriVariables, $context);
 return $result;
 }
}

