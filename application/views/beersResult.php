<div class="col-12 mb-3" style="font-size:1.8em;font-weight:300"> Cervejas </div>
<?php 
if($beersArray)
    foreach($beersArray as $beer) {
?>
        <div class="col-3 search-container" style="height: 275px">
            <div class="insider" style="background: white;height: 100%;border-radius: 5px">
                <div class="header" style="height: 60%;display: flex;align-content: center;justify-content: center;flex-wrap: wrap">
                    <div class="image-cointeiner w-100 text-center">
                        <div style="
                            height: 60px;
                            width: 60px;
                            background: #278bcb;
                            border-radius: 100%;
                            margin: auto;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 2em;
                            color: white;
                        ">
                            <span><?php echo $beer->name[0] ?></span>
                        </div>
                    </div>
                    <div class="person-name text-center mt-2" style="font-size:.9em;width: 100%;font-weight: bold;line-height: 1em">
                        <?php echo $beer->name; ?>
                    </div>
                    
                    <div class="person-info text-center" style="width: 100%;font-size: .9em;color: #a8a8a8">
                        <?php echo $beer->checkins ?> checkins
                    </div>
                </div>

                <div class="info" style="
                    height: 40%;
                    border-top: 1px solid #f9f9f9;
                    display: flex;
                    align-items: center;
                    ">
                    <div class="row w-100 mx-0">
                        <div class="col-6 text-center">
                            <div class="sencond-info-value" style="font-size: 1.5em">
                            <?php echo $beer->alcoholicStrength.'%'; ?>
                            </div>
                            <div class="sencond-info-label"style="font-size:.8em;">
                                Teor Alcoolico
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="sencond-info-value" style="font-size: 1.5em">
                            <?php echo $beer->rating; ?>
                            </div>
                            <div class="sencond-info-label"style="font-size:.8em;">
                                Média
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php };?>