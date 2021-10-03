<style type="text/css">
    .inner h6 {
        text-align: left !important;
    }
  </style>
  
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        
        <div class="row DataList">
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h6 class="node0_0">เข้า <?php echo $node0['ADD'];?> บาท</h6>
                <h6 class="node0_1">ออก <?php echo $node0['PAY'];?> บาท</h6>

                <p style="font-weight:bold; text-align:right; margin-top:12px;">ยอดเครดิตรวม</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h6 class="node1_0">จำนวน <?php echo $node1['cnt'];?> ครั้ง</h6>
                <h6 class="node1_1">เติม/ตัด <?php echo $node1['ADD'];?>/<?php echo $node1['PAY'];?> บาท</h6>
                <p style="font-weight:bold; text-align:right; margin-top:12px;">ยอดจาก POS</p>
              </div>
              <div class="icon">
                <i class="fas fa-cash-register"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
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
          <?php 
          foreach($dataList as $key=>$data) {
          ?>
          <div class="col-lg-3 col-6 ListItem">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h6 id="dataList<?php echo $data['p_key'];?>_<?php echo $key;?>_0">จำนวน <?php echo number_format($data['cnt'],0);?> ครั้ง</h6>
                <h6 id="dataList<?php echo $data['p_key'];?>_<?php echo $key;?>_1">ยอด <?php echo number_format((-1)*$data['balance_sum'],2);?> บาท</h6>
                <p style="font-weight:bold; text-align:right; margin-top:12px;"><?php echo $data['are_name'];?></p>
              </div>
              <div class="icon">
                <i class="fas fa-torii-gate"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <?php
          }
          ?>

        </div>
        <!-- /.row -->

        <style type="text/css">
          #map {
            height: 500px;
          }
        </style>

<script>
//
<?php 
$plon = '98.9430881';
$plat = '18.7113767';
foreach($dataList as $key=>$data) {
?>
var str<?php echo $key;?> = "จำนวน <?php echo number_format($data['cnt'],0);?> ครั้ง<br/>ยอด <?php echo number_format((-1)*$data['balance_sum'],2);?> บาท";
<?php
}
?>
//
var ii=0;
function init() {
  var map = new longdo.Map({
              placeholder: document.getElementById('map')
            });
            map.zoom(17,true);

            map.location({ lon:<?php echo $plon;?>, lat:<?php echo $plat;?> }, true);
            map.location(longdo.LocationMode.Geolocation);
            map.Tags.add(function(tile, zoom) {

              <?php
foreach($dataList as $key=>$data) {
              $plon[5] = rand(0,3);
              $plon[6] = rand(0,5);
?>
              var marker<?php echo $key;?> = new longdo.Marker(
                { lon:<?php echo $plon;?>, lat:<?php echo $plat;?> },{
                  title : '<?php echo $data['are_name'];?>',
                  detail: 'จำนวน <?php echo number_format($data['cnt'],0);?> ครั้ง<br/><?php echo number_format((-1)*$data['balance_sum'],2);?> บาท',
                  icon:{
                    url: '<?php echo base_url('assets/images');?>/map-42871_960_720.webp',
                    offset: { x: 12, y: 45 },
                    size: {width: 50, height: 40}
                  },
              });
              
              map.Overlays.add(marker<?php echo $key;?>);

              if(ii==<?php echo $key;?>) {
                var popup<?php echo $key;?> = new longdo.Popup({lon:<?php echo $plon;?>, lat:<?php echo $plat;?>},
                {
                  title: '<?php echo $data['are_name'];?>',
                  detail: 'จำนวน <?php echo number_format($data['cnt'],0);?> ครั้ง<br/><?php echo number_format((-1)*$data['balance_sum'],2);?> บาท'
                });
                map.Overlays.add(popup<?php echo $key;?>);
              }

              //map.Event.bind('overlayLoad', handler)
<?php
}
?>
              
            });
           

            //map.Overlays.add(popup2);    
            setTimeout(function(){
              ii++;
              if(ii==<?php echo count($dataList);?>) {
                ii=0;
              }
              map.Overlays.clear();
              init();
            },5000);
}

</script>

        <div id="map"></div>