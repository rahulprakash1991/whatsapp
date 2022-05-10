<?php foreach ($drop_menu_client_rep as $key_id => $key_name) 
                                                    {?>
                                                    <option value="<?php echo $key_id;?>" <?php if($key_id == $category_id){?> selected <?php }?>><?php echo $key_name;?></option>

                                                    <?php 
                                                    }?>