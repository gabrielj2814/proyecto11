    <ul>
    <!-- ============================================ SW ============================================ -->
    <!-- MENU -->
        <?php 
        if($menu_lateral['informe']){?>
        <li class="submenu <?php if($menu_actual=='informe'){?>active open<?php }?>" <?php if($menu_actual=='informe'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['informe'])){?>INFORME<?php }else{?><strike style="color:white;"><span>&nbsp;informe&nbsp;</span></strike><?php }?></a>
          <ul>
            <!-- ´SUBMENU -->
            <?php 
            if($menu_lateral['informe_semanal']){
            ?>
            <li><a href="<?php echo $menu_link['informe_semanal'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='informe_semanal'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['informe_semanal'])){?>Semanal<?php }else{?><strike style="color:white;"><span>&nbsp;semanal&nbsp;</span></strike><?php }?></a></li>

            <?php
            }
            ?>
            <?php 
            if($menu_lateral['informe_mensual']){
            ?>
            <li><a href="<?php echo $menu_link['informe_mensual'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='informe_mensual'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['informe_mensual'])){?>Mensual<?php }else{?><strike style="color:white;"><span>&nbsp;mensual&nbsp;</span></strike><?php }?></a></li>

            <?php
            }
            ?>
            
            <!-- FIN SUBMENU -->
          </ul>
        </li>
        <?php }?>
        <?php 
        if($menu_lateral['atencion']){?>
        <li class="submenu <?php if($menu_actual=='atencion'){?>active open<?php }?>" <?php if($menu_actual=='atencion'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['atencion'])){?>ATENCIÓN<?php }else{?><strike style="color:white;"><span>&nbsp;atencion&nbsp;</span></strike><?php }?></a>
          <ul>
            <!-- ´SUBMENU -->
            <?php 
            if($menu_lateral['atencion_diaria']){
            ?>
            <li><a href="<?php echo $menu_link['atencion_diaria'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='atencion_diaria'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['atencion_diaria'])){?>Diaria<?php }else{?><strike style="color:white;"><span>&nbsp;atencion diaria&nbsp;</span></strike><?php }?></a></li>

            <?php
            }
            ?>
             <?php 
            if($menu_lateral['atencion_diaria']){
            ?>
            <li><a href="<?php echo $menu_link['atencion_diaria_federacion'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='atencion_diaria_federacion'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['atencion_diaria_federacion'])){?>Diaria federacion<?php }else{?><strike style="color:white;"><span>&nbsp;atencion diaria&nbsp;</span></strike><?php }?></a></li>

            <?php
            }
            ?>
            
            <!-- FIN SUBMENU -->
          </ul>
        </li>
        <?php }?>
        <?php 
        if($menu_lateral['seguro_medico']){?>
        <li class="submenu <?php if($menu_actual=='seguro_medico'){?>active open<?php }?>" <?php if($menu_actual=='seguro_medico'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['seguro_medico'])){?>SEGURO MÉDICO<?php }else{?><strike style="color:white;"><span>&nbsp;seguro medico&nbsp;</span></strike><?php }?></a>
          <ul>
            <!-- ´SUBMENU -->
            <?php 
            if($menu_lateral['seguimiento']){
            ?>
            <li><a href="<?php echo $menu_link['seguimiento'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='seguimiento'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['seguimiento'])){?>Seguimiento<?php }else{?><strike style="color:white;"><span>&nbsp;seguimiento&nbsp;</span></strike><?php }?></a></li>

            <?php
            }
            ?>
            
            <!-- FIN SUBMENU -->
          </ul>
         
        </li>
        <?php }?>
        <?php 
          if($menu_lateral['centro_m']){?>
          <li class="submenu <?php if($menu_actual=='centro_m'){?>active open<?php }?>" <?php if($menu_actual=='centro_m'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['centro_m'])){?>CENTRO MÉDICO<?php }else{?><strike style="color:white;"><span>&nbsp;seguro medico&nbsp;</span></strike><?php }?></a>
            <ul>
              <!-- ´SUBMENU -->
              <?php 
              if($menu_lateral['centro_medico']){
              ?>
              <li><a href="<?php echo $menu_link['centro_medico'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='centro_medico'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['centro_medico'])){?>centro médico<?php }else{?><strike style="color:white;"><span>&nbsp;centro medico&nbsp;</span></strike><?php }?></a></li>

              <?php
              }
              ?>
            <?php 
              if($menu_lateral['centro_medico_f']){
              ?>
              <li><a href="<?php echo $menu_link['centro_medico_f'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='centro_medico_f'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['centro_medico_f'])){?>centro médico f<?php }else{?><strike style="color:white;"><span>&nbsp;centro medico f&nbsp;</span></strike><?php }?></a></li>

              <?php
              }
              ?>
            
            <!-- FIN SUBMENU -->
          </ul>
          <?php }?>
          
          <?php 
          if($menu_lateral['evaluacion']){?>
          <li class="submenu <?php if($menu_actual=='evaluacion'){?>active open<?php }?>" <?php if($menu_actual=='evaluacion'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['evaluacion'])){?>EVALUACIÓN<?php }else{?><strike style="color:white;"><span>&nbsp;seguro medico&nbsp;</span></strike><?php }?></a>
            <ul>
              <!-- ´SUBMENU -->
              <?php 
              if($menu_lateral['evaluacion_concepto']){
              ?>
              <li><a href="<?php echo $menu_link['evaluacion_concepto'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='evaluacion_concepto'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['evaluacion_concepto'])){?>Evaluación Concepto<?php }else{?><strike style="color:white;"><span>&nbsp;centro medico&nbsp;</span></strike><?php }?></a></li>

              <?php
              }
              ?>
              <!-- ´SUBMENU -->
              <?php 
              if($menu_lateral['evaluacion_jugador']){
              ?>
              <li><a href="<?php echo $menu_link['evaluacion_jugador'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='evaluacion_jugador'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['evaluacion_jugador'])){?>Evaluación jugador<?php }else{?><strike style="color:white;"><span>&nbsp;centro medico&nbsp;</span></strike><?php }?></a></li>

              <?php
              }
              ?>
            
            <!-- FIN SUBMENU -->
          </ul>
          <?php }?>
          <?php 
          if($menu_lateral['perfil_f']){?>
          <li class="submenu <?php if($menu_actual=='perfil_f'){?>active open<?php }?>" <?php if($menu_actual=='perfil_f'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['perfil_f'])){?>PERFIL FISICO<?php }else{?><strike style="color:white;"><span>&nbsp;seguro medico&nbsp;</span></strike><?php }?></a>
            <ul>
              <!-- ´SUBMENU -->
              <?php 
              if($menu_lateral['perfil_fisico']){
              ?>
              <li><a href="<?php echo $menu_link['perfil_fisico'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='perfil_fisico'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['perfil_fisico'])){?>perfil fisico<?php }else{?><strike style="color:white;"><span>&nbsp;centro medico&nbsp;</span></strike><?php }?></a></li>

              <?php
              }
              ?>
            
            <!-- FIN SUBMENU -->
          </ul>
          <?php }?>
          <?php 
          if($menu_lateral['fichajugador']){?>
          <li class="submenu <?php if($menu_actual=='fichajugador'){?>active open<?php }?>" <?php if($menu_actual=='fichajugador'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['fichajugador'])){?>Jugador<?php }else{?><strike style="color:white;"><span>&nbsp;seguro medico&nbsp;</span></strike><?php }?></a>
            <ul>
              <!-- ´SUBMENU -->
              <?php 
              if($menu_lateral['ficha_jugador']){
              ?>
              <li><a href="<?php echo $menu_link['ficha_jugador'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='ficha_jugador'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['ficha_jugador'])){?>Ficha<?php }else{?><strike style="color:white;"><span>&nbsp;centro medico&nbsp;</span></strike><?php }?></a></li>

              <?php
              }
              ?>
            
            <!-- FIN SUBMENU -->
          </ul>
          <?php }?>
          <?php 
          if($menu_lateral['test']){?>
          <li class="submenu <?php if($menu_actual=='test'){?>active open<?php }?>" <?php if($menu_actual=='test'){?>style="border-bottom: 0px;"<?php }?>> <a href="#"><i class="icon-check"></i> <?php if(!$software_demo || ($software_demo && $demo['test'])){?>test<?php }else{?><strike style="color:white;"><span>&nbsp; test &nbsp;</span></strike><?php }?></a>
            <ul>
              <!-- ´SUBMENU -->
              <?php 
              if($menu_lateral['test_ocular_jugador']){
              ?>
              <li><a href="<?php echo $menu_link['test_ocular_jugador'];?>" onClick="colocar_icono_cargando(this)"><?php if($submenu_actual=='test_ocular_jugador'){?><i class="icon-chevron-right" style="text-decoration: none;"></i><?php }?> <?php if(!$software_demo || ($software_demo && $demo['test_ocular_jugador'])){?>test ocular<?php }else{?><strike style="color:white;"><span>&nbsp;test ocular&nbsp;</span></strike><?php }?></a></li>

              <?php
              }
              ?>
              
            
            <!-- FIN SUBMENU -->
          </ul>
          <?php }?>

    <!-- FIN MENU -->
  </ul>
    