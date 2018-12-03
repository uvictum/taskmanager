<thead>
    <tr>
        <th scope="col" >User<img src="/images/sorting.png" class= "sorting_btn" id="1"></th>
        <th scope="col" >Email<img src="/images/sorting.png" class= "sorting_btn" id="2"></th>
        <th scope="col">Text</th>
        <th scope="col">Img</th>
        <th scope="col">Status<img src="/images/sorting.png" class= "sorting_btn" id="3"></th>
    </tr>
</thead>
<tbody>
    <?php foreach($this->tasks as $index => $task) {
        if ($index < 3 * ($this->page - 1)) continue;
        if ($index < 3 * $this->page) {
            include(ROOT . "/views/tpls/single_task.tpl.php");
        } else
            break;
        } ?>
</tbody>
