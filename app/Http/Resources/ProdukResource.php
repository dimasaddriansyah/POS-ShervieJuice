<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                =>  $this->id,
            'supplier'          =>  $this->supplier->nama,
            'nama'              =>  $this->nama,
            'kategori'          =>  $this->kategori->nama,
            'harga'             =>  number_format($this->harga),
            'stok'              =>  $this->stok,
            'stok_masuk'        =>  $this->stok_masuk,
        ];
    }
}
