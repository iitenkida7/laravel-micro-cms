<?php

namespace Iitenkida7\MicroCMS;

use Carbon\CarbonImmutable as Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\PendingRequest;
use Iitenkida7\MicroCMS\BuildQuery;

class MicroCMS
{

  protected PendingRequest $http;

  protected string $endpoint;

  protected string $apiKey;

  protected array $conditions;

  protected string $schema;

  protected $buildQuery;

  // result content
  protected Collection $content;

  public function __construct(BuildQuery $buildQuery)
  {
    $this->endpoint = config('micro-cms.api_endpoint');
    $this->apiKey = config('micro-cms.api_key');
    $this->http = Http::withHeaders(['X-API-KEY' => $this->apiKey]);
    $this->buildQuery = $buildQuery;



  }



  public function schema(string $schema)
  {
    $this->schema = $schema;
    return $this;
  }

  public function setTimeout(int $timeout)
  {
    $this->http = $this->http->timeout($timeout);
  }

  public function demo()
  {
    $this->buildQuery->limit = 1;
    $this->buildQuery->orders = '-updatedAt';
    dd($this->schema('news')->get());    
  }


  private function get(): Collection
  {
      
      $query = http_build_query($this->buildQuery->getConditions());

      $response = $this->http->get($this->endpoint . $this->schema . '?' . $query)->collect();
      $response['contents'] = collect($response['contents'])->map(function ($content) {
          return $this->convertContent($content);
      })->all();

      return $response;
  }

  private function convertContent($content) :object
  {
      $result = collect();
      foreach ($content as $key => $value) {
          if (preg_match('!.*At$!', $key)) {
            $result->$key =  $this->castTimestamp($value);
          }else{
            $result->$key =  $value;

          }
      }
      return $result;
  }

  private function castTimestamp(string $timestamp): string
  {
      return Carbon::parse($timestamp)->timezone('Asia/Tokyo');
  }




}


