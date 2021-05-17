<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/9/2017
 * Time: 7:30 PM
 */

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Report Failure | GTD PREDICTIVE ANALYSIS';
?>

<div class="box-header">
    <h2>Vendor Reporting Input</h2>
    <small>Vendor will report the fixes for the equipments here.</small>
</div>
<div class="box-divider m-0"></div>
<div class="box-body">
    <form role="form">



        <div class="form-group row">
            <label for="inputstation" class="col-sm-2 form-control-label">Gas Station</label>
            <div class="col-sm-10">
                <select id="inputstation" class="form-control select2 c-select" ui-jp="select2" ui-options="{theme: 'bootstrap'}">
                    <optgroup label="Kuala Lumpur">
                        <option value="RYW0620">PSS ALAM DAMAI</option>
                        <option value="RYB0075">PSS AU 5 LEMBAH KERAMAT</option>
                        <option value="RYW1259">PSS BATU 5 JALAN GOMBAK</option>
                        <option value="RYW0289">PSS BRICKFIELDS</option>
                    </optgroup>
                    <optgroup label="Selangor">
                        <option value="RYB0189">PSS BATU 6 PEKAN MERU</option>
                        <option value="RYB0974">PSS JALAN HAJI SIRAT</option>
                        <option value="RYB1062">PSS KUANG</option>
                        <option value="RYB1040">PSS ALAM SUTERA</option>
                        <option value="RYB0974">PSS DENGKIL</option>
                        <option value="RYB0723">PSS FEDERAL HIGHWAY BATU 3</option>
                        <option value="RYB0686">PSS GRAND SAGA 3</option>
                    </optgroup>
                    <optgroup label="Kelantan">
                        <option value="RYD0951">PSS JELAWAT</option>
                        <option value="RYD0266">PSS JELI</option>
                        <option value="RYD0526">PSS KASA</option>
                        <option value="RYD0546">PSS KM10 JALAN KUALA KRAI (KOTA BHARU BOUND)</option>
                        <option value="RYD0203">PSS KM5 JALAN SULTAN YAHYA PETRA</option>
                        <option value="RYD0065">PSS KOK LANAS</option>
                        <option value="RYD0228">PSS MACHANG</option>
                        <option value="RYD0489">PSS PERUPOK</option>
                        <option value="RYD0655">PSS PULAU MELAKA</option>
                    </optgroup>
                    <optgroup label="Terengganu">
                        <option value="RYT0533">PSS AJIL</option>
                        <option value="RYT0215">PSS BATU BUROK</option>
                        <option value="RYT1136">PSS BATU RAKIT</option>
                    </optgroup>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 form-control-label">Problem Type</label>
            <div class="col-sm-10">
                <select class="form-control input-c">
                    <option>Breakaway Coupling Dislodged</option>
                    <option>Breakaway Coupling Leaking</option>
                    <option>Guard Worn Out/Missing</option>
                    <option>Hose Deformed</option>
                    <option>Hose Leaking</option>
                    <option>Hose Worn Off/Leaking</option>
                    <option>Latch Spring Faulty</option>
                    <option>Latch Spring Missing/Broken</option>
                    <option>No Auto Stop</option>
                    <option>Short Hose Came Off</option>
                    <option>Short Hose Cracked</option>
                    <option>Short Hose Leaking</option>
                    <option>Spout Leaking</option>
                    <option>Spout Spring Broken/Missing</option>
                    <option>Swivel Joint Leaking</option>
                    <option>Trigger Loose/Hard To Press</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="replacement" class="col-sm-2 form-control-label">Replacement Parts  No.</label>
            <div class="col-sm-10">
                <input type="text" id="replacement" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="attach" class="col-sm-2 form-control-label">Attachment</label>
            <div class="col-sm-10">
                <input type="file" id="attach" class="form-control">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 form-control-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="form-group row m-t-md">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn dark">Submit</button>
            </div>
        </div>
    </form>
</div>


