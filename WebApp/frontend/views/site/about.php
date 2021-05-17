<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
?>
<div class="item dark">
    <div class="item-bg">
        <img src="<?= Yii::getAlias('@web') ?>/images/bg.jpg" class="blur opacity-3">
    </div>
    <div class="container p-a">
        <div class="p-y-lg text-center text-white">
            <div class="display-4 _300">About Us</div>
            <div class="h4 _400">With our remarkable services & solutions, we help to flourish your business</div>
        </div>

    </div>
</div>

<div class="container padding">

    <div class="row m-a-0">
        <div class="col-md-4 push-md-8">
            <div class="b-l pos-stc-sm text" bs-affix data-offset-top="-80" >
                <div class="box-header p-b-0">
                    <h5>Contents</h5>
                </div>
                <div class="box-body p-t-0">
                    <div class="list-group text-primary-hover no-bg">
                        <a class="list-item p-l-0" href="#overview" ui-scroll-to="overview">Overview</a>
                        <a class="list-item p-l-0" href="#ourvalue" ui-scroll-to="ourvalue">Our Values</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 pull-md-4">

            <!-- INTRO -->
            <div id="overview">
                <h3 class="_300">Overview</h3>
                <p>
                    Utunity is an IT consulting and solution provider of next-gen business collaborate with customers throughout the world.
                    With exceptional experience, comprehensive intelligence system across diverse industries and domains,
                    we work with customers to turn them into some of the most successful and high-performance Organizations.
                </p>
                <p>
                    Incepted in 2013, Utunity is headquartered at Kulala Lumpur, Malaysia with presence in Uzbekistan, Russia and the USA.
                    The commitment to quality and the spirit to innovate has made us serve over 200+ clients across 10 countries with 75% client retention.
                </p>
                <p>
                    Utunity’ IT, business services and solutions support clients who comprise the current world economy,
                    right from small-medium businesses to the most successful global Organizations.
                    Our stakeholders rely on us for innovative solutions,
                    expertise and services in Web, Mobility, Gaming, Open Source frameworks, Embedded Services and IT Consulting.
                    Our objective is to deliver robust, scalable, viable and quality solutions while adhering to strict deadline.
                </p>
            </div>
            <br/>

            <!-- OUT VALUE -->
            <div id="ourvalue">
                <h3 class="_300">Our Value</h3>
                <p>
                    Since inception, Utunity has been directed by a set of values that has shaped the way we work and defined our relationship with clients,
                    employees and community as a whole. Today, these values, imbibed with the company’s vision and mission, act as directive
                    compass guiding our business strategies and future growth. Guided by integrity and respect, we deliver trust,
                    confidentiality and ethics whereas, excellence talks about our skills and ambitions
                </p>
                <p>
                    Inspired by “To accelerate success, we must get as close to our dreams as possible as soon as possible”
                    by Richie Norton, we don’t just deliver promises but also unforgettable experiences.
                    By sharing our client’s aspiration, we understand them and align our dynamics with their objectives – so that we can
                    thrive mutually by contributing to the community.
                </p>
                <p>
                    We rely on our business partners and employees on how we connect to the outside world.
                    With lasting, distinctive and substantial solutions, we improve customer business performance.
                    Everyone at Hidden Brains gives maximum leverage to clients so that we can create a brighter future – together.
                </p>
            </div>
            <br/>



        </div>

    </div>

</div>
