<?php 
include 'connect.php';
include 'session.php';
$name=$_SESSION['name'];
$id=$_SESSION['id'];?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ContactBook</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <script src="dist/js/jquery.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
    <script src="assets/js/holder.js"></script>

    </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ContactBook</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#" data-toggle="modal" data-target="#mymodal">Add Contact</a></li>
            <li><a href="#" data-toggle="modal" data-target="#logout">Logout</a></li>
            <li><a href="#" style="color:#fff"><strong><?php echo  $name;?></strong></a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

        <div class="col-sm-12 col-md-12 main">
          <h2 class="sub-header">My Contacts</h2>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Phone Number</th>
                  <th>Mail</th>
                  <th>Category</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
               <?php
               $id=$_SESSION['id'];
               $sql="SELECT * FROM contact WHERE user_id=?";
               $data=$conn->prepare($sql); 
              $data->execute(array($id));
             while ($row = $data->fetch(PDO::FETCH_ASSOC)) { 
                    $con_id=$row['id'];
                ?>
                  <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['pnumber']; ?></td>
                  <td><?php echo $row['mail']; ?></td>
                  <td><?php echo $row['category']; ?></td>
                  <td>
                    <button type="submit" name="delete" class="btn btn-danger" data-toggle="modal" data-target="#delete<?php echo $con_id; ?>">Remove</button>&nbsp
                    <button type="submit" name="edit" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $con_id; ?>">Edit</button>
                  </td>
                </tr>

                <div class="modal fade" id="delete<?php echo $con_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <form action="lib.php" method="post">
                        <div class="modal-body" style="height:100px; FONT-size:20px; overflow:hidden;"></br>
                        <center><STRONG> Are you sure you want to delete <?php echo $row['name']."?";?></STRONG></center>
                        <input type="hidden" value="<?php echo $con_id;?>" name="del_id">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-danger" name="delete">yes</button>
                        </div>
                      </form>
                      </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
              </div><!-- /.modal -->


            <div class="modal fade" id="edit<?php echo $con_id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><center>EDIT CONTACT</center></h4>
                    </div>
                    <form action="lib.php" method="POST">
                    <div class="modal-body">
                    <div class="col-lg-12">
                      <div class="panel panel-success">
                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Name:</span>
                        <input type="text" name="name" class="form-control input-sm" value="<?php echo $row['name'];?>"/>
                      </div>
                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Phone Number:</span>
                        <input type="telephone" name="number" class="form-control input-sm" value="<?php echo $row['pnumber'];?>"/>
                      </div>
                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Mail:</span>
                        <input type="email" name="mail" class="form-control input-sm" value="<?php echo $row['mail'];?>"/>
                      </div>
                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Category:</span>
                        <input type="text" name="category" class="form-control input-sm" value="<?php echo $row['category'];?>"/>
                        <input type="hidden" value="<?php echo $con_id; ?>" name="hide"/>
                      </div>                      
                          
                  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="edit" class="btn btn-primary">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.modal -->

                <?php
               }
           ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><center>ADD CONTACT</center></h4>
      </div>
    <form action="lib.php" method="POST">
      <div class="modal-body">
       <div class="col-lg-12">
              <div class="panel panel-success">
        
             
                

                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Name:</span>
                        <input type="text" name="name" class="form-control input-sm" />
                      </div>
                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Phone Number:</span>
                        <input type="telephone" name="number" class="form-control input-sm" />
                      </div>
                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Mail:</span>
                        <input type="email" name="mail" class="form-control input-sm" />
                      </div>
                      <div class="input-group input-sm">
                        <span class="input-group-addon input-sm">Category:</span>
                        <input type="text" name="category" class="form-control input-sm" />
                        <input type="hidden" value="<?php echo $id; ?>" name="id"/>
                      </div>                      
                    
                  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="save" class="btn btn-primary">Save</button>
      </div>
    </div><!-- /.modal-content -->
  </form>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div><!-- /.modal -->


<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" style="height:100px; FONT-size:20px; overflow:hidden;"></br>
      <center><STRONG> Are you sure you want to logout?</STRONG></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="logout.php" type="button" class="btn btn-danger">yes</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    
  </body>
</html>
