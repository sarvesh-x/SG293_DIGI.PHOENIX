<div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-3">
                    <div class="card profile-card">
                        <div class="profile-header">&nbsp;</div>
                        <div class="profile-body">
                            <div class="image-area">
                                <img src="images/<?php echo $logo; ?>" alt=""style="width:150px;height:150px;" />
                                <form action="model/page_action.php" method="post" enctype="multipart/form-data" name="changer" style="padding:10px; ">
<input type="hidden" name="cmp_code" value="<?php echo $cmp_code; ?>">
<input name="imagefile" accept="image/jpeg" type="file" style="border: 0px; ">
<input type="submit" value="Upload" class="btn btn-danger"style="width:100%;margin:5px; " name="cmp_logo_upload">
</form>
                            </div>
                            <div class="content-area">
                                <h4><?php echo $cmp_name; ?></h4>
                                <p><?php echo $cmp_address; ?></p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
					<div class="col-xs-12 col-sm-9">
						<div class="card">
							<div class="body">
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Company Profile</a></li>
                                    
                                   
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                       
                                    
                                    <form class="form-horizontal" action="model/page_action.php" method="post">
                                            <div class="form-group">
                                                <label for="NameSurname" class="col-sm-2 control-label">Company name</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="NameSurname" name="NameSurname" placeholder="Company name" value="<?php echo $cmp_name; ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="<?php echo $cmp_email; ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Mobile</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="Email" name="mob" placeholder="Mobile No." value="<?php echo $cmp_mob; ?>" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="Email" class="col-sm-2 control-label">Password</label>
                                                <div class="col-sm-10">
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" id="Email" name="cmp_password" placeholder="Password" value="<?php echo $password; ?>" required>
                                                    </div>
                                                </div>
                                            </div>



                                        
                                            <br>
                                            <input type="hidden" name="id" value="<?php echo $cmp_code ?>">
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="submit" name="update_cmp_profile" class="btn btn-danger" value="SUBMIT">
                                                </div>
                                            </div>
                                        </form>
                                       
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>