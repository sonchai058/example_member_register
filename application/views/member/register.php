  <div class="card">
<!--
              <div class="card-header text-right">
                <button data-toggle="modal" data-target="#myModalAdd" onclick="" class="btn btn-primary" type="button"><i class="fas fa-plus"></i> Add</button>
              </div>
-->
              <!-- /.card-header -->
              <div class="card-body">
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
                                    <!--
                                    <div class="row">
                                        <div class="col-12">
                                            <label>จังหวัด <font color="red">*</font></label>
                                            <select class="form-control" placeholder="จังหวัด" name="province_id" value="<?php echo $data['province_id'];?>">
                                            <?php
                                            $rs = array();
                                            //$rs = $this->common_model->custom_query("select * from address_code ");
                                            foreach($rs as $key1=>$data1) {
                                            ?>
                                              <option <?php if($data['member_type_id']==$data1['member_type_id']){?> selected <?php }?> value="<?php echo $data1['member_type_id'];?>"><?php echo $data1['type_name'];?></option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </div>
                                    </div>
                                    -->

                                    <br/>
                                    <div class="row">
                                        <div class="col-12 text-center" style="text-align:center">
                                            <a href="#" id="bt_addSubmit" class="btn btn-primary"><i class="fa fa-save"></i> บันทึก</a>
                                            <a href="#" class="btn btn-danger" onclick="location.reload()"><i class="fa fa-times" aria-hidden="true"></i> ยกเลิก</a>
                                        </div>
                                    </div>
                                </form>
              </div>
              <!-- /.card-body -->
</div>
