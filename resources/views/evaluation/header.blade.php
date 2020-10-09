<div class="row visible-print">
    <div class="col-xs-4 col-xs-offset-4">
        <center>
            <strong>ព្រះរាជាណាចក្រកម្ពុជា</strong><br>
            <strong>ជាតិ  សាសនា  ព្រះមហាក្សត្រ</strong>
        </center>
    </div>
</div>

<div class="row visible-print">
    <div class="col-xs-4">
        <center>
            <strong>ក្រសួងអប់រំ យុវជន និងកីឡា</strong><br>
            <strong>នាយកដ្ឋានហិរញ្ញវត្ថុ</strong>
        </center>
    </div>
</div>

<div class="row visible-print">
    <div class="col-xs-4 col-xs-offset-4">
        <center>
            <strong>ការពិនិត្យតាមដាន</strong><br>
            <strong>ការគ្រប់គ្រងហិរញ្ញវត្ថុនៅតាមសាលារៀន</strong>
        </center>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <p>១. ឈ្មោះសាលាៈ <span class="name"></span></p>
    </div>
    <div class="col-xs-4">
        <p>២.កម្រិតៈ <span class="level"></span></p>
    </div>
    <div class="col-xs-4">
        <div class="col-xs-3">លេខកូដៈ </div>
        <div class="col-xs-9 visible-print"><span class="code-school"></span></div>
        <div class="col-xs-9 hidden-print">
            <select name="code" id="code" data-url="{{ url('/') }}/school/select2" data-code="{{ url('/') }}/school/code" class="form-control">
                @isset($evaluation)
                    <option value="{{ $evaluation->school->id }}">{{ $evaluation->school->code }}</option>
                @endisset
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <p>៣. ទីតាំងសាលាៈ <span class="address"></span></p>
    </div>
    <div class="col-xs-4">
        <p>៤. តំបន់ៈ <span class="zone"></span></p>
    </div>
</div>