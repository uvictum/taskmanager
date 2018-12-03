<?php
    echo '<tr id="'.$task['ID'].'">';
    foreach ($task as $key => $val) {
        if ($key == "ImageLink") {
            echo '<td><img src="' . $val . '" class="img-thumbnail"></td>';
        } elseif ($key != "ID" && $key != "CreateDate") {
            if ($key == "Status") {
                $val = $val == 0 ? "<p>In Progress</p>" : "<p>Complete</p>";
            }
            echo '<td class="task' . $key . '">' . $val . '</td>';
        }
    }?>
</tr>
