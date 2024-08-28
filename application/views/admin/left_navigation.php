<style>
ul {
background-color:#ecfaff;
border-radius: 20px;
padding-top:20px;
padding-bottom:20px;
}

ul li a {
margin-bottom:15px;
color:#000 !important;
font-size:16px;
font-weight:600;
}

</style>

<ul>
    <li> <a href="<?php echo base_url()?>admin/dashboard"> Dash Baord </a> </li>
    <li> <a href="<?php echo base_url()?>admin/addNews"> Add News </a> </li>

    <li> </li>
    <li> <a target='_blank' href="<?php echo base_url()?>Scrape/mpinfoNewsXmlLink"> MP Info Data </a> </li>
    <li> <a target='_blank' href="<?php echo base_url()?>Scrape/SyncMpinfoData"> Publish MP Info Data </a> </li>

    <li> </li>
    <!-- <li> <a target='_blank' href="#"> Video Section </a>  </li> -->
    <li> <a target='_blank' href="<?php echo base_url()?>admin/videoList"> Video List </a> </li>
    <li> <a target='_blank' href="<?php echo base_url()?>scrape/getMPinfoVideo"> Get MP info Video </a> </li>

    <li> </li>
    <li> <a href="<?php echo base_url()?>admin/Logout"> Logout </a> </li>
</ul> 