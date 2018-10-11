<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sudoku Solver</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
		<style>
		  td.cell input {
		      width: 25px;
		      height: 25px;
		      text-align: center;
		      color: white;
		      background: none !important;
		      border: none;
		  }
		  td.cellGroupA td.cell input {
		      color: #00FF00;
		  }
		  td.cellGroupB td.cell input {
		      color: #006400;
		  }
		  td.cellGroupA td.cell {
		      border: 1px solid #006400;
		      background-color: #006400;
		  }
		  td.cellGroupB td.cell {
		      border: 1px solid #00FF00;
		      background-color: #00FF00;
		  }
		  
		</style>
    </head>
    <body>
     	<div class="container">
     		{{ Form::model($data, ['route' => 'sudoku.store', 'method' => 'post']) }}
     			@csrf
         		<div id="sudokuBoard">
                    <table cellspacing="0" cellpadding="0">
                        <tbody><tr>
                            <td class="cellGroupA">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="1" >{{ Form::text('1', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="2" >{{ Form::text('2', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="3" >{{ Form::text('3', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="10" >{{ Form::text('10', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="11" >{{ Form::text('11', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="12" >{{ Form::text('12', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="19" >{{ Form::text('19', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="20" >{{ Form::text('20', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="21" >{{ Form::text('21', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td class="cellGroupB">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="4" >{{ Form::text('4', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="5" >{{ Form::text('5', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="6" >{{ Form::text('6', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="13" >{{ Form::text('13', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="14" >{{ Form::text('14', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="15" >{{ Form::text('15', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="22" >{{ Form::text('22', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="23" >{{ Form::text('23', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="24" >{{ Form::text('24', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td class="cellGroupA">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="7" >{{ Form::text('7', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="8" >{{ Form::text('8', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="9" >{{ Form::text('9', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="16" >{{ Form::text('16', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="17" >{{ Form::text('17', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="18" >{{ Form::text('18', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="25" >{{ Form::text('25', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="26" >{{ Form::text('26', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="27" >{{ Form::text('27', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                        <tr>
                            <td class="cellGroupB">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="28" >{{ Form::text('28', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="29" >{{ Form::text('29', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="30" >{{ Form::text('30', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="37" >{{ Form::text('37', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="38" >{{ Form::text('38', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="39" >{{ Form::text('39', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="46" >{{ Form::text('46', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="47" >{{ Form::text('47', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="48" >{{ Form::text('48', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td class="cellGroupA">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="31" >{{ Form::text('31', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="32" >{{ Form::text('32', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="33" >{{ Form::text('33', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="40" >{{ Form::text('40', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="41" >{{ Form::text('41', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="42" >{{ Form::text('42', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="49" >{{ Form::text('49', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="50" >{{ Form::text('50', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="51" >{{ Form::text('51', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td class="cellGroupB">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="34" >{{ Form::text('34', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="35" >{{ Form::text('35', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="36" >{{ Form::text('36', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="43" >{{ Form::text('43', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="44" >{{ Form::text('44', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="45" >{{ Form::text('45', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="52" >{{ Form::text('52', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="53" >{{ Form::text('53', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="54" >{{ Form::text('54', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                        <tr>
                            <td class="cellGroupA">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="55" >{{ Form::text('55', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="56" >{{ Form::text('56', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="57" >{{ Form::text('57', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="64" >{{ Form::text('64', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="65" >{{ Form::text('65', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="66" >{{ Form::text('66', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="73" >{{ Form::text('73', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="74" >{{ Form::text('74', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="75" >{{ Form::text('75', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td class="cellGroupB">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="58" >{{ Form::text('58', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="59" >{{ Form::text('59', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="60" >{{ Form::text('60', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="67" >{{ Form::text('67', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="68" >{{ Form::text('68', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="69" >{{ Form::text('69', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="76" >{{ Form::text('76', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="77" >{{ Form::text('77', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="78" >{{ Form::text('78', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                            <td class="cellGroupA">
                                <table cellspacing="1" cellpadding="0">
                                    <tbody><tr>
                                        <td class="cell">
                                            <div id="61" >{{ Form::text('61', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="62" >{{ Form::text('62', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="63" >{{ Form::text('63', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="70" >{{ Form::text('70', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="71" >{{ Form::text('71', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="72" >{{ Form::text('72', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="cell">
                                            <div id="79" >{{ Form::text('79', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="80" >{{ Form::text('80', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                        <td class="cell">
                                            <div id="81" >{{ Form::text('81', null,['autocomplete' => 'off',  'maxlength' => 1]) }}</div>
                                        </td>
                                    </tr>
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
                <button type="submit">Solve</button>
            {{ Form::close() }}
     	</div>
     	@if ($errors->has('message'))
     		{{ $errors->first('message') }}
     	@endif
    </body>
</html>
