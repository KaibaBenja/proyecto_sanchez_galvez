<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsultaModel extends Model
{
    protected $table = 'consultas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'email', 'tel', 'mensaje'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $returnType = 'array';
}