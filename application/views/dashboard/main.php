<style type="text/css">
    /*
    .inner h6 {
        text-align: left !important;
    }
    .headList {
      list-style: none;
    }
    */
  </style>
  
      <div class="container-fluid" style="padding-top: 3px">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="offset-md-2 offset-sm-2 col-md-8 col-sm-8 col-12">
            <!-- small card -->
            <div class="small-box bg-gradient-success">
              <div class="inner">
                <h3>Jungle De Cafe Funpark</h3>
                <p class="info-box-text">ผู้ใช้บริการจำนวน  <b id="head_00">-</b> ท่าน ยอดเงินในระบบ <b id="head_01">-</b> บาท</p>
                <p class="info-box-text">ใช้จ่าย  <b id="head_10">-</b> บาท คงเหลือ <b id="head_11">-</b> บาท</p>
              </div>
              <div class="icon">
                <i class="fas fa-chart-pie"></i>
              </div>
              <a href="javascript:{}" class="small-box-footer">
                <p class="info-box-text">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>RFID</th>
                      <th>จำนวน (ชิ้น)</th>
                      <th>ยอดเงิน (บาท)</th>
                      <th>ใช้งาน (ครั้ง)</th>
                      <th>ใช้จ่าย (บาท)</th>
                      <th>คงเหลือ (บาท)</th>
                    </tr>
                  </thead>
                  <tbody class="headList">
              <?php
              foreach($headList as $key=>$data) {
              ?>
                    <tr>
                      <td align="center"><?php echo $data['type_id'];?></td>
                      <td align="">-</td>
                      <td align="">-</td>
                      <td align="">-</td>
                      <td align="">-</td>
                      <td align="">-</td>
                    </tr>
              <?php
              }
              ?>
                  </tbody>
                </table>
                </p>
              </a>
            </div>
          </div>

        </div>

        <div class="row DataList">
<?php
foreach($dataList as $key=>$data) {
?>
          <div class="col-lg-3 col-6 ListItem">
            <div class="small-box bg-gradient-warning">
              <div class="inner">
                <p style="font-weight:bold; "><?php echo $data['are_name'];?></p><h6 id="0">จำนวน - ครั้ง</h6><h6 id="">ยอดเงิน - บาท</h6>
              </div>
              <div class="icon"><i class="fas fa-torii-gate"></i></div>
            </div>
          </div>
<?php
}
?>
          <!--
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info">
              <div class="inner">
                <h6 class="node0_0">เข้า - บาท</h6>
                <h6 class="node0_1">ออก - บาท</h6>

                <p style="font-weight:bold; text-align:right; margin-top:12px;">ยอดเครดิตรวม</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger">
              <div class="inner">
                <h6 class="node1_0">จำนวน - ครั้ง</h6>
                <h6 class="node1_1">เติม/ตัด -/- บาท</h6>
                <p style="font-weight:bold; text-align:right; margin-top:12px;">ยอดจาก POS</p>
              </div>
              <div class="icon">
                <i class="fas fa-cash-register"></i>
              </div>
            </div>
          </div>
          -->
          <!--
          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          -->

        </div>
        <!-- /.row -->

<div class="card">

<!--<div class="card-header text-right">-->
  <!--<input type="file" hidden="hidden" name="fileImport" id="fileImport">
  <button onclick="$('#fileImport').trigger('click')" class="btn btn-success" type="button"><i class="fas fa-file-import"></i> Import CSV</button>-->
  <!--<button data-toggle="modal" data-target="#myModalAdd" onclick="" class="btn btn-primary" type="button"><i class="fas fa-plus"></i> Add</button>-->
<!--</div>-->
<!-- /.card-header -->
<div class="card-body w_example1">
  <table id="example1" class="table table-bordered table-striped">
    <thead>
    <tr>
      <th>วันที่</th>
      <th>รหัส Transecion</th>
      <th>ประเภท Transecion</th>
      <th>เลขที่ RFID</th>
      <th>เครื่องอ่าน</th>
      <th>ราคา</th>
      <th>ยอดคงเหลือ</th>
      <th>เลขที่อ้างอิง</th>
      <th>Timestamp</th>
      <th>ผลการเรียก API</th>
    </tr>
    </thead>
    <tbody id="listTable">
    <?php 
    foreach($dataListTable as $key=>$data) {
      //continue;
    ?>
    <tr>
      <td><?php echo dateChange3($data['log_date']);?></td>
      <td align="center"><?php echo $data['trans_code'];?></td>
      <td align="center"><?php echo $data['trans_type'];?></td>
      <td align="center"><?php echo $data['refid'];?></td>
      <td align="center"><?php echo $data['reader_id'];?><br/><?php echo $data['reader_name'];?></td>
      <td><?php echo number_format($data['amount'],0);?></td>
      <td><?php echo number_format($data['balance'],0);?></td>
      <td align="center"><?php echo $data['sys_ref_code'];?></td>
      <td align="center"><?php echo date2thai($data['timestamp']);?></td>
      <td align="center"><?php echo $data['api_result'];?></td>
    </tr>

           </div>
          </div>
      </div>

    <?php
    }
    ?>

    </tbody>
    <tfoot>
    <tr>
    <th>วันที่</th>
      <th>รหัส Transecion</th>
      <th>ประเภท Transecion</th>
      <th>เลขที่ RFID</th>
      <th>เครื่องอ่าน</th>
      <th>ราคา</th>
      <th>ยอดคงเหลือ</th>
      <th>เลขที่อ้างอิง</th>
      <th>Timestamp</th>
      <th>ผลการเรียก API</th>
    </tr>
    </tfoot>
  </table>
</div>
<!-- /.card-body -->
</div>