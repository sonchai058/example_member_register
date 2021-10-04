  <div class="card">
<!--
              <div class="card-header text-right">
                <button data-toggle="modal" data-target="#myModalAdd" onclick="" class="btn btn-primary" type="button"><i class="fas fa-plus"></i> Add</button>
              </div>
-->
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="7%">ID Label</th>
                    <th width="20%">เลขบัตร ปชช.</th>
                    <th>คำนำหน้า</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>เบอร์โทร</th>
                    <th>วันเกิด</th>
                    <th>ที่อยู่</th>
                    <th>อัปเดต</th>
                    <!--<th>#</th>-->
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                  foreach($dataList as $key=>$data) {
                  ?>
                  <tr>
                    <td align="center"><?php echo $data['id'];?></td>
                    <td align="center"><?php echo $data['card_idnumber'];?></td>
                    <td><?php echo $data['title_name']?></td>
                    <td><?php echo $data['name'];?></td>
                    <td><?php echo $data['lastname'];?></td>
                    <td align="center"><?php echo $data['telno'];?></td>
                    <td align="center"><?php echo date2thai($data['date_ofbirth']);?></td>
                    <td><?php echo $data['idhouse'];?> หมู่.<?php echo $data['moo'];?> ถ.<?php echo $data['road'];?> ต.<?php echo $data['TambonThaiShort'];?> อ.<?php echo $data['DistrictThaiShort'];?> จ.<?php echo $data['ProvinceThai'];?></td>
                    <td align="center"><?php echo date2Thai($data['mod_date']);?><br/><?php echo $data['mod_user'];?></td>
                    <!--<td align="center"><?php if($data['status']=='1'){echo 'Active';}else{echo 'Inactive';}?></td>-->
                <!--    
                    <td  width="10%">
                      <button data-toggle="modal" data-target="#myModalEdit<?php echo $data['id'];?>" type="button" class="btn btn-info"><i class="fas fa-edit"></i></button>
                      <button onclick="if(confirm('ยืนยัน ลบ!')){dlt(<?php echo $data['id'];?>)}" type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </td>
                  -->
                  </tr>


                          <!-- Modal -->
                          <div class="modal fade" id="myModalEdit<?php echo $data['id'];?>" role="dialog">
                        <div class="modal-dialog modal-xl">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-body modal-p" style="">
                                <div class="row">
                                    <div class="col-12 text-center" style="padding-left: 30px;padding-right: 30px;">
                                        <h2 style="text-align:center" class="font-weight-bold font-title text-h5 text-center">แก้ไขรายการ</h2>
                                    </div>
                                </div>
                                <form id="formEdit<?php echo $data['id'];?>" method="post">
                                
                                    <input type="hidden" name="status" value="<?php echo $data['status'];?>">
                                    <input type="hidden" name="id" value="<?php echo $data['id'];?>">
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <label>คำนำหน้า</label>
                                            <select class="form-control" placeholder="คำนำหน้า" name="title_name" value="<?php echo $data['title_name'];?>">
                                                <option <?php if($data['title_name']=='นาย'){?> selected <?php }?> value="นาย">นาย</option>
                                                <option <?php if($data['title_name']=='นาง'){?> selected <?php }?> value="นาง">นาง</option>
                                                <option <?php if($data['title_name']=='นางสาว'){?> selected <?php }?> value="นางสาว">นางสาว</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>ชื่อ <font color="red">*</font></label>
                                            <input type="text" class="form-control" name="name" placeholder="ชื่อ" value="<?php echo $data['name'];?>">
                                        </div>
                                    </div>
                                    <br/> 
                                    <div class="row">
                                        <div class="col-12">
                                            <label>นามสกุล</label>
                                            <input type="text" class="form-control" name="lastname" placeholder="นามสกุล" value="<?php echo $data['lastname'];?>">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>เลขประจำตัว ประชาชน <font color="red">*</font></label>
                                            <input readonly type="text" maxlength="13" class="form-control" name="card_idnumber" placeholder="เลขประจำตัว ประชาชน" value="<?php echo $data['card_idnumber'];?>">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>เบอร์ติดต่อ</label>
                                            <input type="text" class="form-control" name="telno" placeholder="เบอร์ติดต่อ" value="<?php echo $data['telno'];?>">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>วัน/เดือน/ปีเกิด (พศ)</label>
                                            <input type="date" class="form-control" name="date_ofbirth" placeholder="วัน/เดือน/ปีเกิด (พศ)" value="<?php echo $data['date_ofbirth'];?>">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>บ้านเลขที่</label>
                                            <input type="text" class="form-control" name="idhouse" placeholder="บ้านเลขที่" value="<?php echo $data['idhouse'];?>">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>หมู่</label>
                                            <input type="text" class="form-control" name="moo" placeholder="หมู่" value="<?php echo $data['moo'];?>">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>ถนน</label>
                                            <input type="text" class="form-control" name="road" placeholder="ถนน" value="<?php echo $data['road'];?>">
                                        </div>
                                    </div>
                                    <!--
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>จังหวัด <font color="red">*</font></label>
                                            <select class="form-control" placeholder="จังหวัด" name="province_id" value="<?php echo $data['province_id'];?>">
                                            <?php
                                            $rs = array();
                                            $rs = $this->address_model->province_list();
                                            foreach($rs as $key1=>$data1) {
                                            ?>
                                              <option  value="<?php echo $data1['ProvinceID'];?>"><?php echo $data1['ProvinceThai'];?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    -->
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>ผู้เพิ่ม : </label>
                                            <?php echo $data['add_user'];?> <?php echo date2Thai($data['add_date']);?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>ล่าสุด : </label>
                                            <?php echo $data['mod_user'];?> <?php echo date2Thai($data['mod_date']);?>
                                        </div>
                                    </div>

                                    <br/>
                                    <div class="row">
                                        <div class="col-12 text-center" style="text-align:center">
                                            <a href="#" onclick="editSave(<?php echo $data['id'];?>);" id="bt_editSubmit<?php echo $data['id'];?>" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</a>
                                            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> ยกเลิก</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                          
                         </div>
                        </div>
                    </div>

                  <?php
                  }
                  ?>

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID Label</th>
                    <th>เลขบัตร ปชช.</th>
                    <th>คำนำหน้า</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>เบอร์โทร</th>
                    <th>วันเกิด</th>
                    <th>ที่อยู่</th>
                    <th>อัปเดต</th>
                    <!--<th>#</th>-->
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>



                      <!-- Modal -->
                      <div class="modal fade" id="myModalAdd" role="dialog">
                        <div class="modal-dialog modal-xl">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-body modal-p" style="">
                                <div class="row">
                                    <div class="col-12 text-center" style="padding-left: 30px;padding-right: 30px;">
                                        <h2 style="text-align:center" class="font-weight-bold font-title text-h5 text-center">เพิ่มรายการใหม่</h2>
                                    </div>
                                </div>
                                <form id="formAdd" method="post">
                                    <input type="hidden" name="status" value="1">
                                    
                                    <div class="row">
                                        <div class="col-12">
                                            <label>คำนำหน้า <font color="red">*</font></label>
                                            <select class="form-control" placeholder="คำนำหน้า" name="title_name" value="นาย">
                                                <option value="นาย">นาย</option>
                                                <option value="นาง">นาง</option>
                                                <option value="นางสาว">นางสาว</option>
                                            </select>
                                        </div>
                                    </div> 
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>ชื่อ <font color="red">*</font></label>
                                            <input type="text" class="form-control" name="name" placeholder="ชื่อ" value="">
                                        </div>
                                    </div>
                                    <br/> 
                                    <div class="row">
                                        <div class="col-12">
                                            <label>นามสกุล</label>
                                            <input type="text" class="form-control" name="lastname" placeholder="นามสกุล" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>เลขประจำตัว ประชาชน <font color="red">*</font></label>
                                            <input type="text" maxlength="13" class="form-control" name="card_idnumber" placeholder="เลขประจำตัว ประชาชน" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>เบอร์ติดต่อ</label>
                                            <input type="text" class="form-control" name="telno" placeholder="เบอร์ติดต่อ" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>วัน/เดือน/ปีเกิด (พศ)</label>
                                            <input type="date" class="form-control" name="date_ofbirth" placeholder="วัน/เดือน/ปีเกิด (พศ)" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>บ้านเลขที่</label>
                                            <input type="text" class="form-control" name="idhouse" placeholder="บ้านเลขที่" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>หมู่</label>
                                            <input type="text" class="form-control" name="moo" placeholder="หมู่" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>ถนน</label>
                                            <input type="text" class="form-control" name="road" placeholder="ถนน" value="">
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12">
                                            <label>จังหวัด</label>
                                            <select class="form-control" placeholder="จังหวัด" name="province_id" value="" id="province_id">
                                                <option value="">เลือกจังหวัด</option>
                                            <?php
                                            $rs = array();
                                            $rs = $this->address_model->province_list();
                                            foreach($rs as $key1=>$data1) {
                                            ?>
                                              <option  value="<?php echo $data1['ProvinceID'];?>"><?php echo $data1['ProvinceThai'];?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="row">
                                        <div class="col-12 text-center" style="text-align:center">
                                            <a href="#" id="bt_addSubmit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</a>
                                            <a href="#" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> ยกเลิก</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                          
                         </div>
                        </div>
                    </div>
