<?php

namespace App\Models;

use CodeIgniter\Model;

class Item extends Model
{
    protected $table      = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = ['transaksi_id', 'nama_item', 'jumlah', 'satuan', 'harga'];

    public function insertItem($transaksiId, $items)
    {
        $item = new Item();
        $data = [];
        for ($i = 0; $i < count($items['item']); $i++) {
            $data[] = [
                'transaksi_id' => $transaksiId,
                'nama_item' => strtoupper($items['item'][$i]),
                'jumlah' => $items['jumlah'][$i],
                'satuan' => $items['satuan'][$i],
                'harga' => $items['harga'][$i],
            ];
        }
        return $item->insertBatch($data);
    }
}
