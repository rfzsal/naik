<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Naik Store - Admin</title>
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url() ?>assets/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url() ?>assets/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/favicon-16x16.png">
  <link rel="manifest" href="<?php echo base_url() ?>assets/site.webmanifest">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/lte/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/lte/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/lte/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/skin-blue.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/custom.css">
  <?php 
    if(isset($css)){
      echo $css;
    }
  ?>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
    html {
      color: #212121;
    }
  </style>
</head>