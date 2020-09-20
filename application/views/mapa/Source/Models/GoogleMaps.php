<?php

namespace Source\Models;

/**
 * GoogleMaos: Classe de integração com o Google Maps geocode criada na aula
 * Consumo e personalização do Google Maps + Geocode via API
 * 
 * @author Paulo Pimentel <www.paulohgpimentel@gmail.com>
 * @link https://www.upinside.com.br/ Saiba mais
 * @copyright (c) 2017, Paulo H.G Pimentel - Desenvolvedor WEB
 */
class GoogleMaps
{

    private $apiUrl;
    private $apiKey;
    private $params;
    private $callback;
    private $latLng;
    private $address;

    /* Gera o link de conexão ao fazer uma instância da classe */
    public function __construct()
    {
        $this->apiKey = "AIzaSyBTQ-ye5YsB_1ZnD2QBwjcRrZwNY-C_kIk";
        $this->apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?key={$this->apiKey}&sensor=false&language=pt-BR";
    }

    /**
     * setAddress: Define qual endereço buscar
     * @param string $params Endereço (Florianópolis | Florianópolis Campeche | Rua XPTO)
     */
    public function setAddress($params)
    {
        // verifica se a string possui espaços e troca por +
        $this->params = str_replace(" ", "+", $params);
        $this->get();
        return $this;
    }

    /**
     * getAddress: Retorna o endereço escrito
     * @return string Florianópolis = Florianópolis, Santa Catarina, Brasil
     */
    public function getAddress()
    {
        $this->address = $this->callback->results[0]->formatted_address;
        return $this->address;
    }

    /**
     * getLatLng: Retorna latitude e longitude do endereço
     * @return object ->lat and ->lng
     */
    public function getLatLng()
    {
        $this->latLng = $this->callback->results[0]->geometry->location;
        return $this->latLng;
    }

    /**
     * getCallback: Retorna o objeto completo do endereço
     * @return object Todos os atributos.
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Efetua uma comunicação via HTTP GET
     */
    private function get()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->apiUrl}&address={$this->params}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }

}
