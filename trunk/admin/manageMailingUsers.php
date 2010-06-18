<?php session_start ();?>
<?php if(!$_SESSION['userAdmin']):?>
<?php header("location:loginForm.php");?>
<?php else:?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Users - Admin Template</title>
<link rel="stylesheet" type="text/css" href="../css/adminTheme.css" />
<link rel="stylesheet" type="text/css" href="../css/adminStyle.css" />
<link rel="stylesheet" type="text/css" href="../css/adminTheme4.css" />
<script type="text/javascript" src="../js/prototype.js"></script>
 <script type="text/javascript" src="../js/logout.js"></script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/ie-sucks.css" />
<![endif]-->
</head>

<body>
	<div id="container">
    	<div id="header">
        	<h2>My eCommerce Admin area</h2>
    <div id="topmenu">
            	<ul>
            		<li><a href="index.php">Dashboard</a></li>
                    <li><a href="images.php">Imagenes</a></li>
                	<li class="current"><a href="manageMailingUsers.php">Users</a></li>
                	<li><a href="#">Statistics</a></li>
              </ul>
          </div>
      </div>
        <div id="top-panel">
            <div id="panel">

            </div>
      </div>
        <div id="wrapper">
            <div id="content">
                <div id="box">
                	<h3>Users</h3>
                	<table width="100%">
						<thead>
							<tr>
                            	<th width="40px"><a href="#">ID<img src="../images/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
                            	<th><a href="#">Email</a></th>
                                <th><a href="#">Nombre</a></th>
                                <th width="40px"><a href="#">Estado</a></th>
                                <th width="100px"><a href="#">Ingresado en la fecha</a></th>
                                <th width="60px"><a href="#">Action</a></th>
                            </tr>
						</thead>
						<tbody>
						<?php 
						include("../logica/manageMailing.class.php");
						$manage = new manageMailing();
						$index = 0;
						$auxDatos = $manage->getAllMailingUsers();
						while($index < count($auxDatos)):
						?>
						<tr>
                            	<td class="a-center"><?php echo $auxDatos[$index]?></td>
                            	<td><a href="#"><?php echo $auxDatos[$index+1]?></a></td>
                                <td><?php echo $auxDatos[$index+2]?></td>
                                <td><?php echo $auxDatos[$index+3]?></td>
                                <td><?php echo $auxDatos[$index+4]?></td>
                                <td><a href="#"><img src="../images/icons/user.png" title="Show profile" width="16" height="16" /></a><a href="#"><img src="../images/icons/user_edit.png" title="Edit user" width="16" height="16" /></a><a href="#"><img src="../images/icons/user_delete.png" title="Delete user" width="16" height="16" /></a></td>
                        </tr>
                            <?php $index = $index+5;?>
						<?php endwhile;?>	
						</tbody>
					</table>
                    <div id="pager">
                    	Page <a href="#"><img src="../images/icons/arrow_left.gif" width="16" height="16" /></a> 
                    	<input size="1" value="1" type="text" name="page" id="page" /> 
                    	<a href="#"><img src="../images/icons/arrow_right.gif" width="16" height="16" /></a>of 42
                    pages | View <select name="view">
                    				<option>10</option>
                                    <option>20</option>
                                    <option>50</option>
                                    <option>100</option>
                    			</select> 
                    per page | Total <strong>420</strong> records found
                    </div>
                </div>
                <br />
                <!--  
                <div id="box">
                	<h3 id="adduser">Add user</h3>
                    <form id="form" action="..." method="post">
                      <fieldset id="personal">
                        <legend>PERSONAL INFORMATION</legend>
                        <label for="lastname">Last name : </label> 
                        <input name="lastname" id="lastname" type="text" tabindex="1" />
                        <br />
                        <label for="firstname">First name : </label>
                        <input name="firstname" id="firstname" type="text" 
                        tabindex="2" />
                        <br />
                        <label for="email">Email : </label>
                        <input name="email" id="email" type="text" 
                        tabindex="2" />
                        <br />
                        <p>Send auto generated password 
                            <input name="generatepass" id="yes" type="checkbox" 
                        value="yes" tabindex="35" /></p>
                        <label for="pass">Password : </label>
                        <input name="pass" id="pass" type="password" 
                        tabindex="2" />
                        <br />
                        <label for="pass-2">Password : </label>
                        <input name="pass-2" id="pass-2" type="password" 
                        tabindex="2" />
                        <br />
                      </fieldset>
                      <fieldset id="address">
                        <legend>Address</legend>
                        <label for="street">Street address : </label> 
                        <input name="street" id="street" type="text" 
                        tabindex="1" />
                        <br />
                        <label for="city">City : </label>
                        <input name="city" id="city" type="text" 
                        tabindex="2" />
                        <br />
                        <label for="country">Country : </label> 
                        <input name="country" id="country" type="text" 
                        tabindex="1" />
                        <br />
                        <label for="state">State/Province : </label>
                        <input name="state" id="state" type="text" 
                        tabindex="2" />
                        <br />
                        <label for="zip">Zip/Postal Code : </label>
                        <input name="zip" id="zip" type="text" 
                        tabindex="2" />
                        <br />
                        <label for="tel">Telephone : </label>
                        <input name="tel" id="tel" type="text" 
                        tabindex="2" />
                      </fieldset>
                      <fieldset id="opt">
                        <legend>OPTIONS</legend>
                        <label for="choice">Group : </label>
                        <select name="choice">
                          <option selected="selected" label="none" value="none">
                          General
                          </option>
                          <optgroup label="Group 1">
                            <option label="cg1a" value="val_1a">Selection group 1a
                            </option>
                            <option label="cg1b" value="val_1b">Selection group 1b
                            </option>
                            <option label="cg1c" value="val_1c">Selection group 1c
                            </option>
                          </optgroup>
                          <optgroup label="Group 2">
                            <option label="cg2a" value="val_2a">Selection group 2a
                            </option>
                            <option label="cg2b" value="val_2a">Selection group 2b
                            </option>
                          </optgroup>
                          <optgroup label="Group 3">
                            <option label="cg3a" value="val_3a">Selection group 3a
                            </option>
                            <option label="cg3a" value="val_3a">Selection group 3b
                            </option>
                          </optgroup>
                        </select>
                      </fieldset>
                      <div align="center">
                      <input id="button1" type="submit" value="Send" /> 
                      <input id="button2" type="reset" />
                      </div>
                    </form>

                </div>
                -->
            </div>
            <div id="sidebar">
  				<ul>

                    <li><h3><a href="#" class="folder_table">Imagenes</a></h3>
          				<ul>
                        	<li><a href="#" class="addorder">Nueva imagen</a></li>
                          <li><a href="#" class="shipping">Manejar</a></li>
                        </ul>
                    </li>
                  <li><h3><a href="#" class="user">Users</a></h3>
          				<ul>
                            <li><a href="#" class="useradd">Nuevo usuario</a></li>
                            <li><a href="#" class="group">Mandar notificacion</a></li>
                        </ul>
                    </li>
                   <li>
                    	<h3><a href="#" onclick='return adminLogout()'>Salir</a></h3>
                    </li>
				</ul>       
          </div>
      </div>
        <div id="footer">
        <div id="credits">
   		Template by Yo
        </div>
        <div id="styleswitcher">
            
        </div><br />

        </div>
</div>
</body>
</html>
<?php endif;?>