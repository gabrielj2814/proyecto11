<div class="container-fluid" style="margin-top:0px;    margin-top: 0px;padding-right: 0px;padding-left: 0px;margin-left: auto;margin-right: auto;width: 95%;" >    
                                                            <div class="row-fluid" style="margin-top: 10px;"  >     
                                                                
                                                        
                                                        <div class="span12" style="display:inline-flex;flex-wrap:wrap; justify-content: space-evenly;" >
                                                                <?php
                                                                $titulo_masculino=false;     
                                                                foreach ($series AS $indice => $valor) {
                                                                    $arreglo_serie = t_serie($indice);
                                                                    if ($arreglo_serie[1] == 1 ) { 
                                                                    $titulo_masculino=true;     
                                                                    ?>
                                                                        <div  style="text-align: center; margin: 0px; box-sizing:border-box;border:0;width:19%;margin-bottom:15px;">
                                                                            <div class="cuadro_serie"  onclick="consultarJugadorPorSerie('<?php print($arreglo_serie[0]."_".$arreglo_serie[1]);  ?>')">
                                                                                <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                                                                <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                                                                <?php $numero = 0;
                                                                                ?>
                                                                                <i class='icon-male'></i><b style="font-size:12px;" id="cantidad_serie_<?php print($arreglo_serie[0]);?>"></b>
                                                                            </div>
                                                                        </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                            <?php
                                                                $titulo_femenino=false;     
                                                                foreach ($series AS $indice => $valor) {
                                                                    $arreglo_serie = t_serie($indice);
                                                                    if ($arreglo_serie[1] == 2 ) { 
                                                                    $titulo_femenino=true;     
                                                                    ?>
                                                                        <div  style="text-align: center; margin: 0px; box-sizing:border-box;border:0;width:19%;">
                                                                            <div class="cuadro_serie"  onclick="consultarJugadorPorSerie('<?php  print($arreglo_serie[0]."_".$arreglo_serie[1]); ?>')">
                                                                                <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                                                                <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                                                                <?php $numero = 0;
                                                                                ?>
                                                                                <!-- cantidad_serie_8 -->
                                                                                <i class='icon-female'></i><b style="font-size:12px;" id="cantidad_serie_<?php print($arreglo_serie[0]."_".$arreglo_serie[1]);?>"></b>
                                                                            </div>
                                                                        </div>
                                                                <?php } ?>
                                                            <?php } ?>
                                                                </div>  
                                                        
                                            
                                                            
                                                            
                                            </div>        
                                                            
                                                    
                                            
                                                    <?php 
                                                    if($titulo_masculino==false){
                                                        echo "<script>$('.titulo_masculino').hide();</script>";
                                                    }  
                                                    if($titulo_femenino==false){
                                                        echo "<script>$('.titulo_femenino').hide();</script>";
                                                    }                                            
                                                                                                
                                                    ?>                                             
                                        
                                    </div>