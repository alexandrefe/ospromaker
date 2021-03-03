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

  private function queryString()
  {
      if (isset($_SERVER['QUERY_STRING'])) {
           $str = preg_replace("/(\?|&)?page=[0-9]+/i", '', $_SERVER['QUERY_STRING']);
          $str = str_replace(['?', '&'], ['', ''], $str);
          return (strlen($str) === 0) ? '' : $str . '&';
        }
  }

  public function renderLinks($totalRegisters)
    {
        $totalPages = $this->totalPages($totalRegisters);

        $startLinks = 1;
        if ($this->currentPage > $this->linksPerPage) {
            $startLinks = $this->currentPage - $this->linksPerPage;
        }

        $endLinks = $totalPages;
        if (($this->currentPage + $this->linksPerPage) < $totalPages) {
            $endLinks = $this->currentPage + $this->linksPerPage;
        }

        $query = $this->queryString();

        $links = '<ul class="pagination">';

        if ($this->currentPage > 1) {
            $previousPage = $this->currentPage - 1;
            $links .= "<li class='page-item'> <a class='page-link rounded-0' href='?{$query}page=1'>Primeiro</a></li>";
            $links .= "<li class='page-item'> <a class='page-link rounded-0' href='?{$query}page={$previousPage}'>Anterior</a></li>";
        }

        for ($i = $startLinks; $i <= $endLinks ; $i++) {
            $active = $this->currentPage == $i ? 'active' : '';
            $links .= "<li class='page-item {$active}'> <a class='page-link rounded-0' href='?{$query}page={$i}'> {$i} </a></li>";
        }

        if ($this->currentPage < $totalPages) {
            $nextPage = $this->currentPage + 1;
            $links .= "<li class='page-item'> <a class='page-link rounded-0' href='?{$query}page={$nextPage}'>Próximo</a></li>";
            $links .= "<li class='page-item'> <a class='page-link rounded-0' href='?{$query}page={$totalPages}'>último</a></li>";
        }

        $links .= '</ul>';

        return $links;
    }

}