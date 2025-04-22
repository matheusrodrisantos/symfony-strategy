<?php

namespace App\Evento\DTO;

class EventoOutputDTO
{
    public readonly ?int $id;
    public readonly ?string $name;
    public readonly ?string $tipo;
    public readonly ?string $aberto;
    public readonly ?float $valor;
    public readonly ?\DateTimeImmutable $dataInicio;
    public readonly ?\DateTimeImmutable $dataFim;
    public readonly ?bool $online;
    public readonly ?bool $presencial;
    

    public function __construct(
        ?int $id,
        ?string $name,
        ?string $tipo,
        ?string $aberto,
        ?float $valor,
        ?\DateTimeImmutable $dataInicio,
        ?\DateTimeImmutable $dataFim,
        ?bool $online,
        ?bool $presencial,
        
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->tipo = $tipo;
        $this->aberto = $aberto;
        $this->valor = $valor;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
        $this->online = $online;
        $this->presencial = $presencial;
        
    }

    // Método toArray
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'tipo' => $this->tipo,
            'aberto' => $this->aberto,
            'valor' => $this->valor,
            'dataInicio' => $this->dataInicio ? $this->dataInicio->format('Y-m-d H:i:s') : null,
            'dataFim' => $this->dataFim ? $this->dataFim->format('Y-m-d H:i:s') : null,
            'online' => $this->online,
            'presencial' => $this->presencial            
        ];
    }
}
