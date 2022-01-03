<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
$pro_id =  (int)$_GET['pro'];

if ($pro_id > 0){

$_product = wc_get_product($pro_id);

$_name = $_product->get_name();
$_price = $_product->get_price();
$_image = wp_get_attachment_image_src( get_post_thumbnail_id( $_product->get_id() ), 'single-post-thumbnail' );

?>
<!--query <?php //print_r($_product); ?> -->

<div class="devvn_tragop_wrap">
    <div class="devvn_tragop_box">
        <div class="devvn_tragop_prod">

            <div class="devvn_tragop_prod_left"><img width="211" height="211" src="<?php echo $_image[0];?>" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt=""></div>
            <div class="devvn_tragop_prod_right">
                <h1>Mua trả góp: <a href="<?php echo $_product->get_permalink();?>"><?php echo $_product->get_name();?></a></h1>
                <span>Giá bán: <strong><span class="woocommerce-Price-amount amount- text-danger"><bdi><?php echo number_format($_price, 0, '', '.');?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></strong></span>
            </div>
        </div>


        <?php
         if (isset($_POST['submit'])) {
            
            $post_content = "
   <strong>Thông tin sản phẩm</strong>
   <table style='width: 100%; border-style: solid; border-color: #ddd; border-collapse: collapse;' border='1' cellspacing='1' cellpadding='1'>
      <tbody>
         <tr>
            <td width='230'>Tên sản phẩm</td>
            <td><a href='". $_product->get_permalink()."'>" . $_product->get_name()."</a></td>
         </tr>
         <tr>
            <td width='230'>Giá sản phẩm</td>
            <td><span class='woocommerce-Price-amount amount'><bdi>" . number_format($_price, 0, '', '.') ."<span class='woocommerce-Price-currencySymbol'>₫</span></bdi></span></td>
         </tr>
      </tbody>
   </table>
   <strong>Thông tin khách hàng</strong>
   <table style='width: 100%; border-style: solid; border-color: #ddd; border-collapse: collapse;' border='1' cellspacing='1' cellpadding='1'>
      <tbody>
         <tr>
            <td width='230'>Họ và tên</td>
            <td>" . $_POST['vimo_name']."</td>
         </tr>
         <tr>
            <td width='230'>Số điện thoại</td>
            <td>" . $_POST['vimo_phone']."</td>
         </tr>
         <tr>
            <td width='230'>Email</td>
            <td>" . $_POST['vimo_email']."</td>
         </tr>
         <tr>
            <td width='230'>Địa chỉ</td>
            <td>" . $_POST['vimo_address']."</td>
         </tr>
      </tbody>
   </table>
   <strong>Thông tin trả góp</strong>
   <table style='width: 100%; border-style: solid; border-color: #ddd; border-collapse: collapse;' border='1' cellspacing='1' cellpadding='1'>
      <tbody>
         <tr>
            <td width='230'>Hình thức</td>
            <td>" . $_POST['tragop_name']."</td>
         </tr>
         <tr>
            <td width='230'>Tên ngân hàng/công ty</td>
            <td>" . $_POST['bank_name']."</td>
         </tr>
         <tr>
            <td width='230'>Trả trước</td>
            <td>" . $_POST['bank_tratruoc']."</td>
         </tr>
         <tr>
            <td width='230'>Số tháng&nbsp;trả góp</td>
            <td>" . $_POST['bank_month']." tháng</td>
         </tr>
         <tr>
            <td width='230'>Số tiền trả mỗi tháng</td>
            <td>" . $_POST['bank_tramoithang']."₫</td>
         </tr>
         <tr>
            <td width='230'>Phí đóng tiền hàng tháng</td>
            <td>" . $_POST['bank_thuho']."₫/ tháng</td>
         </tr>
         <tr>
            <td width='230'>Bảo hiểm khoản vay</td>
            <td>
            " . $_POST['bank_baohiem']."                      
            </td>
         </tr>
         <tr>
            <td width='230'>Tổng cuối</td>
            <td>" . $_POST['bank_total']."₫</td>
         </tr>
         <tr>
            <td width='230'>Chênh lệch</td>
            <td>" . $_POST['bank_chenhlech']."₫</td>
         </tr>
         <tr>
            <td width='230'>Ngày đăng ký</td>
            <td>" . date('d-m-Y H:i:s') ."</td>
         </tr>
      </tbody>
   </table>
   <p>Lưu ý: Số tiền thực tế có thể chênh lệch với bảng tính này.</p>
   ----------------<br><b>".get_bloginfo( 'name' )."</b><br><br>

   HÀ NỘI: Số 40, Lô A1, Khu đô thị Đại Kim, Phường Định Công, Quận Hoàng Mai, Hà Nội <br>
   Điện thoại: (024) 6658 9858 <br>
   Kinh doanh 1: 0867.919.468 <br>
   Kinh doanh 2: 0865.565.468 <br><br>
   HỒ CHÍ MINH: Số 4/12A, Bàu Bàng, P. 13, Q. Tân Bình, TP. HCM <br>
   Điện thoại: (028) 6658 0203 <br>
   Kinh doanh 1: 0868.399.468 <br>
   Kinh doanh 2: 0862.515.468
     ";

     echo "<div class='devvn_tragop_main bank' id='devvn_tragop_main'>
     <p class='mess_success'>Cảm ơn đã đăng ký mua trả góp. Chúng tôi sẽ liên hệ với bạn sớm!</p>";
      echo $post_content;
      echo "<p class='text-center'><a href='/' class='btn_continue_buy'>Tiếp tục mua hàng</a></p></div>";


// Create post object
//$post_content ='';
$my_post = array(
    'post_title'    => $_POST['vimo_name'] . ' - ' . $_POST['vimo_phone'],
    'post_content'  => $post_content,
    'post_type' => 'tragop',
    'post_status'   => 'pending',
    'post_author'   => 1
);
// Insert the post into the database
$post_ID = wp_insert_post( $my_post );
$updated_post = array(
  'ID'            => $post_ID,
  'post_title'    => '#' .$post_ID . ' - ' . $_POST['vimo_name'] . ' - ' . $_POST['vimo_phone'],
);
wp_update_post($updated_post);

$admin_email = get_option('admin_email');
$headers[] = 'Bcc: ' . $admin_email;
wp_mail($_POST['vimo_email'], "Đơn hàng tại " . get_bloginfo( 'name' ) ." đã được đặt!", "<h3>Cảm ơn đã đăng ký mua trả góp. Chúng tôi sẽ liên hệ với bạn sớm!</h3>" . $post_content, $headers);

?>

        <?php }
        else {
        ?>

<div class="devvn_tragop_main bank" id="devvn_tragop_main">
   <div class="devvn_installment_type">
      <p class="devvn_tragop_title">Chọn phương thức trả góp</p>
      <ul id="choose_type">
         <li class="type-bank">
            <label>
            <input type="radio" name="type" value="bank" class="type_installment">
            <strong class="type type-cty active">
            CÔNG TY TÀI CHÍNH <small>Duyệt hồ sơ trong một giờ</small>
            </strong>
            </label>
         </li>
         <li class="type-vimo">
            <label>
            <input type="radio" name="type" value="vimo" class="type_installment">
            <strong class="type type-cc">
            QUA THẺ TÍN DỤNG <small>Không cần xét duyệt</small>
            </strong>
            </label>
         </li>
      </ul>
   </div>
   <div class="devvn_installment_bank">
      <form id="bank_tragop" method="post">
         <div class="product-description-wrapper tragop-content vimo-cty-tragop" id="tragop">
            <input type="hidden" name="vimo_bank_prod_price" id="vimo_bank_prod_price" value="<?php echo $_product->get_price();?>">
            <input type="hidden" name="vimo_bank_prod_id" id="vimo_bank_prod_id" value="<?php echo $_product->get_id();?>">
            
            <div id="list-feature-month" class="pb-1">Các kì hạn có gói <b class="text-danger">Trả góp 0% - 1%</b>: 3 tháng, 6 tháng</div>
            
            <p class="title">Chọn số tháng trả góp</p>
            <ul class="tragop-month clearfix">
               <li class=""><a href="javascript:void(0)" data-month="3">3 tháng</a></li>
               <li class="active"><a href="javascript:void(0)" data-month="6">6 tháng</a></li>
               <li class=""><a href="javascript:void(0)" data-month="8">8 tháng</a></li>
               <li class=""><a href="javascript:void(0)" data-month="9">9 tháng</a></li>
               <li class=""><a href="javascript:void(0)" data-month="12">12 tháng</a></li>
            </ul>
            <div class="table_tragop_wrap">
               <table class="tragop-table">
                  <tbody>
                     <tr>
                        <td>Công ty</td>
                        <td class="home-credit">
                           <img src="/wp-content/plugins/tragop/images/bank/m-credit-mb.png" alt="">
                           <input type="hidden" id="home-bank_name" value="Mirae Asset">
                        </td>
                        <td class="fe-credit">
                           <img src="/wp-content/plugins/tragop/images/bank/fe-credit.png" alt="">
                           <input type="hidden" id="fe-bank_name" value="FE credit">
                        </td>
                     </tr>
                     <tr>
                        <td>Giá sản phẩm</td>
                        <td class="home-credit"><span class="woocommerce-Price-amount amount-"><bdi><?php echo number_format($_price, 0, '', '.');?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                        <td class="fe-credit"><span class="woocommerce-Price-amount amount-"><bdi>11.390.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                     </tr>
                     <tr>
                        <td>Giá mua trả góp</td>
                        <td class="home-credit text-danger"><span class="woocommerce-Price-amount amount-"><bdi><?php echo number_format($_price, 0, '', '.');?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                        <td class="red fe-credit"><span class="woocommerce-Price-amount amount"><bdi>11.390.000<span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></td>
                     </tr>
                     <tr>
                        <td>
                           Trả trước
                           <select class="tragop-tratruoc">
                              <option value="20">20%</option>
                              <option value="30" selected="">30%</option>
                              <option value="40">40%</option>
                              <option value="50">50%</option>
                              <option value="60">60%</option>
                              <option value="70">70%</option>
                           </select>
                        </td>
                        <td class="tratruoc-val home-credit">3.417.000₫ (30%)</td>
                        <td class="tratruoc-val fe-credit">3.417.000₫ (30%)</td>
                     </tr>
                     <tr>
                        <td>Tiền gốc còn lại</td>
                        <td class="home-tiengoc tiengoc-conlai">7.973.000₫</td>
                        <td class="fe-tiengoc tiengoc-conlai">7.973.000₫</td>
                     </tr>
                     <!--<tr class="hide">
                        <td>Lãi suất</td>
                        <td class="home-laisuat home-credit"><span class="special-percent">0%</span></td>
                        <td class="fe-laisuat fe-credit"><span>3.55%</span></td>
                     </tr>-->
                     <tr>
                        <td>Giấy tờ cần có</td>
                        <td class="home-credit">CMND + Bằng lái xe / hộ khẩu</td>
                        <td class="fe-credit">CMND + Bằng lái xe / hộ khẩu</td>
                     </tr>
                     <tr>
                        <td>Góp mỗi tháng</td>
                        <td class="home-month home-credit">1.169.210₫</td>
                        <td class="fe-month fe-credit">1.211.657₫</td>
                     </tr>
                     <tr class="fix-bg none">
                        <td>Phí thu hộ</td>
                        <td class="home-credit home-thuho">12.000₫/ tháng</td>
                        <td class="fe-credit fe-thuho">12.000₫/ tháng</td>
                     </tr>
                     <tr class="fix-bg none">
                        <td>Bảo hiểm</td>
                        <td class="home-credit home-baohiem">48.724₫/ tháng</td>
                        <td class="fe-credit fe-baohiem">44.294₫/ tháng</td>
                     </tr>
                     <tr>
                        <td>Tổng tiền phải trả</td>
                        <td class="home-total home-credit red text-danger">13.831.890₫</td>
                        <td class="fe-total fe-credit">14.213.917₫</td>
                     </tr>
                     <tr>
                        <td>Chênh lệch với mua trả thẳng <i class="fa fa-info-circle" title="Tiền chênh lệch đã bao gồm tiền lãi + phí đóng tiền hàng tháng + gói bảo hiểm vay (nếu có)."></i></td>
                        <td class="home-chenhlech home-credit">2.441.890₫</td>
                        <td class="fe-chenhlech fe-credit">2.823.917₫</td>
                     </tr>
                  </tbody>
                  <tfoot>
                     <tr>
                        <td></td>
                        <td class="text-center">
                           <a href="javascript:void(0);" class="bank-dangky bank-dangky-mirae" data-for="home">Đăng ký</a>
                        </td>
                        <td><a href="javascript:void(0);" class="bank-dangky bank-dangky-fe" data-for="fe">Đăng ký</a></td>
                     </tr>
                  </tfoot>
               </table>
            </div>
            <div class="bank_infor_customer" style="display: none;">
               <div class="devvn_tragop_box">
                  <label class="devvn_tragop_title">Thông tin người mua</label>
                  <div class="devvn_tragop_col1">
                     <input type="text" name="vimo_name" placeholder="Họ và tên" value="" required>
                  </div>
                  <div class="devvn_tragop_col2">
                     <input type="text" name="vimo_phone" placeholder="Số điện thoại" value="" required>
                  </div>
               </div>
               <div class="devvn_tragop_box">
                  <div class="devvn_tragop_col1">
                     <input type="text" name="vimo_email" placeholder="Email của bạn" value="">
                  </div>
                  <div class="devvn_tragop_col2">
                     <input type="text" name="vimo_address" placeholder="Địa chỉ của bạn" value="">
                  </div>
               </div>
               <div class="devvn_tragop_box">
                  <input type="hidden" id="bank_nonce" name="bank_nonce" value="afdd33863b">
                  <input type="hidden" name="tragop_type" value="bank">
                  <input type="hidden" name="tragop_name" value="Qua công ty tài chính">
                  <input type="hidden" name="bank_tratruoc" id="bank_tratruoc" value="">
                  <input type="hidden" name="bank_month" id="bank_month" value="">
                  <input type="hidden" name="bank_thuho" id="bank_thuho" value="">
                  <input type="hidden" name="bank_baohiem" id="bank_baohiem" value="">
                  <input type="hidden" name="bank_total" id="bank_total" value="">
                  <input type="hidden" name="bank_name" id="bank_name" value="">
                  <input type="hidden" name="bank_chenhlech" id="bank_chenhlech" value="">
                  <input type="hidden" name="bank_tramoithang" id="bank_tramoithang" value="">
                  <input id="bank_btncomplete" type="submit" name="submit" value="Đăng ký ngay">
               </div>
            </div>
            <p style="">
            Lưu ý: Số tiền thực tế có thể chênh lệch với bảng tính này.
            </p>
         </div>
      </form>
   </div>
   <div class="devvn_installment_alepay">
      <form method="post" id="vimo_form">
         <div class="devvn_alepay_box">
            <div class="alepay_label devvn_tragop_title">Bước 1: Chọn ngân hàng trả góp</div>
            <div class="vimo_listbank_mess"></div>
            <div class="vimo_listbank">                                
               <label class="devvn_bank_click" data-code="VCB" data-name="Ngân hàng TMCP Ngoại Thương Việt Nam" title="Ngân hàng TMCP Ngoại Thương Việt Nam">
               <input value="VCB" name="vimo_bank" type="radio" checked>
               <span><img src="/wp-content/plugins/tragop/images/bank/VCB.png" alt="Ngân hàng TMCP Ngoại Thương Việt Nam"></span>
               </label>
               <label class="devvn_bank_click" data-code="TCB" data-name="Ngân hàng TMCP Kỹ Thương" title="Ngân hàng TMCP Kỹ Thương">
               <input value="TCB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/TCB.png" alt="Ngân hàng TMCP Kỹ Thương"></span>
               </label>
               <label class="devvn_bank_click" data-code="MB" data-name="Ngân hàng TMCP Quân Đội" title="Ngân hàng TMCP Quân Đội">
               <input value="MB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/MB.png" alt="Ngân hàng TMCP Quân Đội"></span>
               </label>
               <label class="devvn_bank_click" data-code="VIB" data-name="Ngân hàng TMCP Quốc tế" title="Ngân hàng TMCP Quốc tế">
               <input value="VIB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/VIB.png" alt="Ngân hàng TMCP Quốc tế"></span>
               </label>
               <label class="devvn_bank_click" data-code="EXB" data-name="Ngân hàng TMCP Xuất Nhập Khẩu" title="Ngân hàng TMCP Xuất Nhập Khẩu">
               <input value="EXB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/EXB.png" alt="Ngân hàng TMCP Xuất Nhập Khẩu"></span>
               </label>
               <label class="devvn_bank_click" data-code="ACB" data-name="Ngân hàng TMCP Á Châu" title="Ngân hàng TMCP Á Châu">
               <input value="ACB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/ACB.png" alt="Ngân hàng TMCP Á Châu"></span>
               </label>
               <label class="devvn_bank_click" data-code="MSB" data-name="Ngân hàng TMCP Hàng Hải" title="Ngân hàng TMCP Hàng Hải">
               <input value="MSB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/MSB.png" alt="Ngân hàng TMCP Hàng Hải"></span>
               </label>
               <label class="devvn_bank_click" data-code="VPB" data-name="Ngân hàng TMCP Việt Nam Thịnh Vượng" title="Ngân hàng TMCP Việt Nam Thịnh Vượng">
               <input value="VPB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/VPB.png" alt="Ngân hàng TMCP Việt Nam Thịnh Vượng"></span>
               </label>
               <label class="devvn_bank_click" data-code="STB" data-name="Ngân hàng TMCP Sài Gòn Thương Tín" title="Ngân hàng TMCP Sài Gòn Thương Tín">
               <input value="STB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/STB.png" alt="Ngân hàng TMCP Sài Gòn Thương Tín"></span>
               </label>
               <label class="devvn_bank_click" data-code="BIDV" data-name="Ngân hàng Đầu tư và Phát triển Việt Nam" title="Ngân hàng Đầu tư và Phát triển Việt Nam">
               <input value="BIDV" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/BIDV.png" alt="Ngân hàng Đầu tư và Phát triển Việt Nam"></span>
               </label>
               <label class="devvn_bank_click" data-code="SHB" data-name="Ngân hàng TMCP Sài Gòn - Hà Nội" title="Ngân hàng TMCP Sài Gòn - Hà Nội">
               <input value="SHB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/SHB.png" alt="Ngân hàng TMCP Sài Gòn - Hà Nội"></span>
               </label>
               <label class="devvn_bank_click" data-code="SEA" data-name="Ngân hàng TMCP Đông Nam Á" title="Ngân hàng TMCP Đông Nam Á">
               <input value="SEA" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/SEA.png" alt="Ngân hàng TMCP Đông Nam Á"></span>
               </label>
               <label class="devvn_bank_click" data-code="TPB" data-name="TienphongBank" title="TienphongBank">
               <input value="TPB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/TPB.png" alt="TienphongBank"></span>
               </label>
               <label class="devvn_bank_click" data-code="HSBC" data-name="Ngân hàng TNHH một thành viên HSBC" title="Ngân hàng TNHH một thành viên HSBC">
               <input value="HSBC" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/HSBC.png" alt="Ngân hàng TNHH một thành viên HSBC"></span>
               </label>
               <label class="devvn_bank_click" data-code="SHBKV" data-name="Ngân hàng TNHH MTV Shinhan Việt Nam" title="Ngân hàng TNHH MTV Shinhan Việt Nam">
               <input value="SHBKV" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/SHBKV.png" alt="Ngân hàng TNHH MTV Shinhan Việt Nam"></span>
               </label>
               <label class="devvn_bank_click" data-code="ANZVN" data-name="Ngân hàng TNHH một thành viên ANZ (Việt Nam)" title="Ngân hàng TNHH một thành viên ANZ (Việt Nam)">
               <input value="ANZVN" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/ANZVN.png" alt="Ngân hàng TNHH một thành viên ANZ (Việt Nam)"></span>
               </label>
               <label class="devvn_bank_click" data-code="SCBL" data-name="Ngân hàng TNHH Một thành viên Standard Chartered (Việt Nam)" title="Ngân hàng TNHH Một thành viên Standard Chartered (Việt Nam)">
               <input value="SCBL" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/SCBL.png" alt="Ngân hàng TNHH Một thành viên Standard Chartered (Việt Nam)"></span>
               </label>
               <label class="devvn_bank_click" data-code="SCB" data-name="Ngân hàng Thương Mại Cổ Phần Sài Gòn" title="Ngân hàng Thương Mại Cổ Phần Sài Gòn">
               <input value="SCB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/SCB.png" alt="Ngân hàng Thương Mại Cổ Phần Sài Gòn"></span>
               </label>
               <label class="devvn_bank_click" data-code="CTB" data-name="Ngân hàng Citibank Việt Nam" title="Ngân hàng Citibank Việt Nam">
               <input value="CTB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/CTB.png" alt="Ngân hàng Citibank Việt Nam"></span>
               </label>
               <label class="devvn_bank_click" data-code="FEC" data-name="FE Credit" title="FE Credit">
               <input value="FEC" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/FEC.png" alt="FE Credit"></span>
               </label>
               <label class="devvn_bank_click" data-code="OCB" data-name="Ngân Hàng TMCP Phương Đông Việt Nam" title="Ngân Hàng TMCP Phương Đông Việt Nam">
               <input value="OCB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/OCB.png" alt="Ngân Hàng TMCP Phương Đông Việt Nam"></span>
               </label>
               <label class="devvn_bank_click" data-code="KLB" data-name="Ngân hàng Thương mại Cổ phần Kiên Long" title="Ngân hàng Thương mại Cổ phần Kiên Long">
               <input value="KLB" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/KLB.png" alt="Ngân hàng Thương mại Cổ phần Kiên Long"></span>
               </label>
               <label class="devvn_bank_click" data-code="HOMEC" data-name="Home Credit" title="Home Credit">
               <input value="HOMEC" name="vimo_bank" type="radio">
               <span><img src="/wp-content/plugins/tragop/images/bank/HOMEC.png" alt="Home Credit"></span>
               </label>
            </div>
         </div>
         <div class="devvn_tragop_box">
            <div class="devvn_tragop_col">
               <label for="alepay_prepaid" class="devvn_tragop_title">Bước 2: Số tiền trả trước</label>
               <span class="radio_mess"></span>
               <div class="list_radio_style vimo_prepaid_wrap">
                  <!--<label>
                  <input type="radio" name="vimo_prepaid" class="vimo_prepaid_0" value="0" data-price="<?php echo $_price ?>" data-pricepay="<?php echo $_price ?>">
                  <span><strong>Không <br>trả trước</strong></span>
                  </label>-->
                  <?php
                     $x = 20; $checked = '';
                     while($x < 100) { $tratruoc = ($_price * $x)/100; if ($x==30) {$checked = 'checked';};
                  ?>

                  <label>
                  <input type="radio" name="vimo_prepaid" class="vimo_prepaid_<?php echo $x ?>" value="<?php echo $x ?>" data-price="<?php echo $tratruoc ?>" data-pricepay="<?php echo $tratruoc ?>" <?php echo $checked ?>>
                  <span><strong>Trả trước <?php echo $x ?>%</strong><span class="woocommerce-Price-amount amount"><bdi><?php echo number_format($tratruoc, 0, '', '.');?><span class="woocommerce-Price-currencySymbol">₫</span></bdi></span></span>
                  </label>

                  <?php $x = $x + 10; $checked = ''; } ?>
                  
               </div>
            </div>
         </div>
         <div class="devvn_tragop_box">
            <div class="devvn_tragop_col">
               <label for="alepay_prepaid" class="devvn_tragop_title">Bước 3: chọn kỳ trả góp</label>
               <span class="radio_mess"></span>
               <div class="list_radio_style vimo_cycle_wrap">
                  <label>
                  <input type="radio" name="vimo_cycle" class="vimo_cycle_3" value="3">
                  <span><strong>3</strong>Tháng</span>
                  </label>
                  <label>
                  <input type="radio" name="vimo_cycle" class="vimo_cycle_6" value="6" checked>
                  <span><strong>6</strong>Tháng</span>
                  </label>
                  <label>
                  <input type="radio" name="vimo_cycle" class="vimo_cycle_9" value="9">
                  <span><strong>9</strong>Tháng</span>
                  </label>
                  <label>
                  <input type="radio" name="vimo_cycle" class="vimo_cycle_12" value="12">
                  <span><strong>12</strong>Tháng</span>
                  </label>
                  <!--<label>
                     <input type="radio" name="vimo_cycle" class="vimo_cycle_18" value="18">
                     <span><strong>18</strong>Tháng</span>
                  </label>-->
               </div>
            </div>
         </div>
         <div class="devvn_tragop_box total_vimo_wrap" style="display:block">
            <div class="devvn_tragop_col">
               <ul class="vimo_table_results">
                  <li>
                     <strong>Thanh toán khi nhận hàng</strong>
                     <span class="total_pay">0</span>
                  </li>
                  <li>
                     <strong>Góp mỗi tháng</strong>
                     <span class="total_month">0</span>
                  </li>
                  <li>
                     <strong>Tổng tiền trả góp</strong>
                     <span class="total_vimo">0</span>
                  </li>
                  <li>
                     <strong>Chênh lệch so với giá ban đầu</strong>
                     <span class="chenhlech_vimo">0</span>
                  </li>
               </ul>
            </div>
            <p style="color:#000;padding-top:10px;clear:both">
            Lưu ý: Số tiền thực tế có thể chênh lệch với bảng tính này.
            </p>
         </div>
         <div class="vimo_infor_customer">
            <div class="devvn_tragop_box">
               <label class="devvn_tragop_title">Thông tin người mua</label>
               <div class="devvn_tragop_col1">
                  <input type="text" name="vimo_name" placeholder="Họ và tên" value="" required>
               </div>
               <div class="devvn_tragop_col2">
                  <input type="text" name="vimo_phone" placeholder="Số điện thoại" value="" required>
               </div>
            </div>
            <div class="devvn_tragop_box">
               <div class="devvn_tragop_col1">
                  <input type="text" name="vimo_email" placeholder="Email của bạn" value="">
               </div>
               <div class="devvn_tragop_col2">
                  <input type="text" name="vimo_address" placeholder="Địa chỉ của bạn" value="">
               </div>
            </div>
            <div class="devvn_tragop_box">
               <input type="hidden" id="vimo_nonce" name="vimo_nonce" value="5133340f72">
               <input type="hidden" name="_wp_http_referer" value="">
               <input type="hidden" name="tragop_type" value="vimo">
               <input type="hidden" name="tragop_name" value="Trả góp qua thẻ">
               <input type="hidden" name="prod_id" value="<?php echo $_product->get_id();?>">
               <input type="hidden" name="bank_tratruoc" id="vimo_tratruoc" value="">
               <input type="hidden" name="bank_month" id="vimo_month" value="">
               <input type="hidden" name="bank_thuho" id="vimo_thuho" value="">
               <input type="hidden" name="bank_baohiem" id="vimo_baohiem" value="">
               <input type="hidden" name="bank_total" id="vimo_total" value="">
               <input type="hidden" name="bank_name" id="vimo_name" value="">
               <input type="hidden" name="bank_chenhlech" id="vimo_chenhlech" value="">
               <input type="hidden" name="bank_tramoithang" id="vimo_tramoithang" value="">

               <input id="vimo_btncomplete" type="submit" name="submit" value="Đăng ký ngay">
            </div>
         </div>
      </form>
   </div>
</div>



<?php } ?>

</div>
    <div class="loading-cart">
        <span class="cswrap">
            <span class="csdot"></span>
            <span class="csdot"></span>
            <span class="csdot"></span>
        </span>
    </div>
</div>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

<?php } ?>