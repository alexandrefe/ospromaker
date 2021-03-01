<?php

namespace app\traits;

trait Paginate
{
  protected $limit = 10;
  protected $offset = 0;
  protected $currentPage;
  protected $linksPerPage = 5;

  public function setLimit($limit)
  {
    $this->limit = $limit;
    return $this;
  }

  public function setCurrentPage()
  {
    $this->currentPage = $_GET['page'] ?? 1;
    $this->offset = ($this->currentPage - 1) * $this->limit;
    return $this;
  }

  public function totalPages($total)
  {
    return ceil($total / $this->limit);
  }

  public function renderLinks()
  {
    return 'test';
  }

}