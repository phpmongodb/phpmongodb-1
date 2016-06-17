
<div class="header">
    <h1 class="page-title">Output</h1>
</div>


<div class="well" >


    <p id="execute-response">
        <?php
        if (!empty($this->data['response'])) {
            echo "<pre>";
            print_r($this->data['response']);
            echo "</pre>";
        }
        ?> 
    </p>
</div>