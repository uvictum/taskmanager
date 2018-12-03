<nav aria-label="pagination">
    <ul class="pagination justify-content-center">
<?php

if ($this->page != 1) $pervpage = '<li class="page-item"><a class="page-link" href= /?page=1><<</a></li> 
                               <li class="page-item"><a class="page-link" href= /?page='. ($this->page - 1) .'>Previous</a></li> ';

if ($this->page != $this->lastPage) $nextpage = '<li class="page-item"><a class="page-link" href= /?page='. ($this->page + 1) .'>Next</a></li> 
                                   <li class="page-item"><a class="page-link" href= /?page=' .$this->lastPage. '>>></a></li>';

if($this->page - 2 > 0) $page2left = '<li class="page-item"><a class="page-link" href= /?page='. ($this->page - 2) .'>'. ($this->page - 2) .'</a></li>';
if($this->page - 1 > 0) $page1left = '<li class="page-item"><a class="page-link" href= /?page='. ($this->page - 1) .'>'. ($this->page - 1) .'</a></li>';
if($this->page + 2 <= $this->lastPage) $page2right = '<li class="page-item"><a class="page-link" href= /?page='. ($this->page + 2) .'>'. ($this->page + 2) .'</a></li>';
if($this->page + 1 <= $this->lastPage) $page1right = '<li class="page-item"><a class="page-link" href= /?page='. ($this->page + 1) .'>'. ($this->page + 1) .'</a></li>';

// Вывод меню
echo $pervpage.$page2left.$page1left.'<li class="page-item"><b class="page-link">'.$this->page.'</b></li>'.$page1right.$page2right.$nextpage;

?>
    </ul>
</nav>
