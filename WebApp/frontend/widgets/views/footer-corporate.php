<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/9/2017
 * Time: 7:30 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
?>
<footer class="dark pos-rlt">

    <div class="footer  p-a b-t container">


        <!-- ADDRESS & CONTACT -->
        <div class="row m-t">
            <div class="col-sm-4">
                <div class="row m-b-sm">
                    <div class="col-sm-3"><span class="block text-muted">Address</span></div>
                    <div class="col-sm-9">
                        <span class="block">Suite 310 &amp; 311, Block A, Glomac Business Centre Jalan SS 6/3, Kelana Jaya</span>
                        <span class="block">Petaling Jaya 47301</span>
                        <span class="block">Selangor</span>
                        <span class="block">Malaysia</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="row m-b-sm">
                    <div class="col-sm-3"><span class="block text-muted">Email</span></div>
                    <div class="col-sm-9">
                        <span>info@myangkasa.com.my</span>
                    </div>
                </div>
                <div class="row m-b-sm">
                    <div class="col-sm-3"><span class="block text-muted">Phone</span></div>
                    <div class="col-sm-9">
                        <span> 03 7884 6788</span>
                    </div>
                </div>
                <div class="row m-b-sm">
                    <div class="col-sm-3"><span class="block text-muted">Fax</span></div>
                    <div class="col-sm-9">
                        <span>03 7884 6678</span>
                    </div>
                </div>

                <div class="row m-b-sm">
                    <div class="col-sm-3"><span class="block text-muted">Website</span></div>
                    <div class="col-sm-9">
                        <span><a href="http://http://www.myangkasa.com.my" target="_blank">http://www.myangkasa.com.my</a></span>
                    </div>
                </div>

                <div class="row m-b-sm">
                    <div class="col-sm-3"><span class="block text-muted">Business hours</span></div>
                    <div class="col-sm-9">
                        <div class="form-inline m-b-sm row">
                            <div class="col-md-12">
                                <label>Weekdays</label>
                            </div>
                            <div class="col-md-12">
                                <div class="inline input-group-sm m-r">
                                    <label>start: 08:30 </label>
                                </div>
                                <div class="inline input-group-sm">
                                    <label>end: 17:30 </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">

                <form role="form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" rows="2" placeholder="Message"></textarea>
                    </div>
                    <div class="form-group m-t-md text-right">
                        <button type="submit" class="btn white">Send</button>
                    </div>
                </form>

            </div>
        </div>

        <div class="b b-b m-b m-t-lg"></div>
        <div class="row">
            <div class="col-sm-8">
                <div class="clearfix">
                    <a href="" class="btn btn-icon btn-social btn-sm white">
                        <i class="fa fa-facebook"></i>
                        <i class="fa fa-facebook indigo"></i>
                    </a>
                    <a href="" class="btn btn-icon btn-social btn-sm white">
                        <i class="fa fa-twitter"></i>
                        <i class="fa fa-twitter blue"></i>
                    </a>
                    <a href="" class="btn btn-icon btn-social btn-sm white">
                        <i class="fa fa-google-plus"></i>
                        <i class="fa fa-google-plus red"></i>
                    </a>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="text-sm-right text-xs-left">
                    <small class="text-muted">© Copyright 2017. All rights reserved.</small>
                </div>
            </div>
        </div>

    </div>
</footer>