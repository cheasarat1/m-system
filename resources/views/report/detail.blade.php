<div class="row">
    <div class="col-xs-4">
        <p>១. ឈ្មោះសាលាៈ <span class="name">{{ $school->school }}</span></p>
    </div>
    <div class="col-xs-4">
        <p>២.កម្រិតៈ <span class="level">{{ $school->level }}</span></p>
    </div>
    <div class="col-xs-4">
        <p>លេខកូដៈ <span class="code">{{ $school->code }}</span></p>
    </div>
</div>

<div class="row">
    <div class="col-xs-8">
        <p>៣. ទីតាំងសាលាៈ <span class="address">ឃុំ {{ $school->commune }} ស្រុក {{ $school->district }} ខេត្ត {{ $school->province }}</span></p>
    </div>
    <div class="col-xs-4">
        <p>៤. តំបន់ៈ <span class="zone">{{ $school->zone }}</span></p>
    </div>
</div>

<div class="row">
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="2" rowspan="2" class="text-center" style="vertical-align: middle;">សូចនាករ និងលក្ខខណ្ឌដាក់ពិន្ទ</th>
                <th colspan="3" class="text-center">ពិន្ទលើភាពរីកចម្រើន</th>
                <th rowspan="2" style="vertical-align: middle;">សរុប</th>
            </tr>
            <tr>
                <th class="text-center" style="vertical-align: middle;">គ្មាន​​ =១</th>
                <th class="text-center" style="vertical-align: middle;">មានតែមិនត្រូវ=២</th>
                <th class="text-center" style="vertical-align: middle;">មាននិងត្រឹមត្រូវ=៣</th>
            </tr>
        </thead>
        <tbody>
            <tr style="background-color:#03A9F4;">
                <td width="60px">I</td>
                <td>ប្រសិទ្ធភាព និងស័ក្កសិទ្ធិភាពនៃការអនុវត្តថវិកា</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
            <?php $totalI1 = 0; ?>
            <?php $totalI2 = 0; ?>
            <?php $totalI3 = 0; ?>
            <?php $totalI4 = 0; ?>
            @foreach($ones as $index => $one)
                <tr>
                    <td width="60px" class="text-right">{{ $index + 1 }}</td>
                    <td>{{ substr($one->name, stripos($one->name, ' ')) }}</td>
                    <td class="text-center">{{ $one->score1 }}</td>
                    <?php $totalI1+= $one->score1; ?>
                    <td class="text-center">{{ $one->score2 }}</td>
                    <?php $totalI2+= $one->score2; ?>
                    <td class="text-center">{{ $one->score3 }}</td>
                    <?php $totalI3+= $one->score3; ?>
                    <td class="text-center">{{ $one->total }}</td>
                    <?php $totalI4+= $one->total; ?>
                </tr>
            @endforeach

            <tr style="background-color:yellow;">
                <td colspan="2" class="text-right font-weight-bold">ពិន្ទុសរុប I</td>
                <td class="text-center">{{ $totalI1 }}</td>
                <td class="text-center">{{ $totalI2 }}</td>
                <td class="text-center">{{ $totalI3 }}</td>
                <td class="text-center">{{ $totalI4 }}</td>
            </tr>

            <?php $bad = ($totalI4 >= 1 && $totalI4 <= 66) ? true : false ; ?>
            <?php $good = ($totalI4 >= 67 && $totalI4 <= 90) ? true : false ; ?>
            <?php $best = ($totalI4 >= 91 && $totalI4 <= 129) ? true : false ; ?>

            <tr style="<?php echo ($bad) ? 'background-color:green;': ''; ?>">
                <td>លទ្ធផលៈI</td>
                <td class="font-weight-bold">១. សាលាអនុវត្តការគ្រប់គ្រងហិរញ្ញវត្ថុ គ្មានប្រសិទ្ធភាព</td>
                <td colspan="<?php echo ($bad) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($bad) ? $totalI4 : '' ; ?>
                </td>
            </tr>

            <tr style="<?php echo ($good) ? 'background-color:green;': ''; ?>">
                <td></td>
                <td class="font-weight-bold">២. សាលាអនុវត្តការគ្រងហិរញ្ញវត្ថុ មានប្រសិទ្ធភាពមធ្យម</td>
                <td colspan="<?php echo ($good) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($good) ? $totalI4 : '' ; ?>
                </td>
            </tr>

            <tr style="<?php echo ($best) ? 'background-color:green;': ''; ?>">
                <td></td>
                <td class="font-weight-bold">៣. សាលាអនុវត្តការគ្រងហិរញ្ញវត្ថុ មានប្រសិទ្ធភាពល្អ</td>
                <td colspan="<?php echo ($best) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($best) ? $totalI4 : '' ; ?>
                </td>
            </tr>

            <tr style="background-color:#03A9F4;">
                <td width="60px">II</td>
                <td>សាលារៀនមានសមត្ថភាពរៀបចំផែនការ និងថវិកាផ្អែកលើលទ្ធផល</td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
                <td class="text-center"></td>
            </tr>
            <?php $totalII1 = 0; ?>
            <?php $totalII2 = 0; ?>
            <?php $totalII3 = 0; ?>
            <?php $totalII4 = 0; ?>
            @foreach($two as $index => $t)
                <tr>
                    <td width="60px" class="text-right">{{ $index + 1 }}</td>
                    <td>{{ substr($t->name, stripos($t->name, ' ')) }}</td>
                    <td class="text-center">{{ $t->score1 }}</td>
                    <?php $totalII1+= $t->score1; ?>
                    <td class="text-center">{{ $t->score2 }}</td>
                    <?php $totalII2+= $t->score2; ?>
                    <td class="text-center">{{ $t->score3 }}</td>
                    <?php $totalII3+= $t->score3; ?>
                    <td class="text-center">{{ $t->total }}</td>
                    <?php $totalII4+= $t->total; ?>
                </tr>
            @endforeach

            <tr style="background-color:yellow;">
                <td colspan="2" class="text-right font-weight-bold">ពិន្ទុសរុប II</td>
                <td class="text-center">{{ $totalII1 }}</td>
                <td class="text-center">{{ $totalII2 }}</td>
                <td class="text-center">{{ $totalII3 }}</td>
                <td class="text-center">{{ $totalII4 }}</td>
            </tr>

            <?php $bad = ($totalII4 >= 1 && $totalII4 <= 66) ? true : false ; ?>
            <?php $good = ($totalII4 >= 67 && $totalII4 <= 90) ? true : false ; ?>
            <?php $best = ($totalII4 >= 91 && $totalII4 <= 129) ? true : false ; ?>

            <tr style="<?php echo ($bad) ? 'background-color:green;': ''; ?>">
                <td>លទ្ធផលៈII</td>
                <td class="font-weight-bold">១. សាលាអនុវត្តការគ្រប់គ្រងហិរញ្ញវត្ថុ គ្មានប្រសិទ្ធភាព</td>
                <td colspan="<?php echo ($bad) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($bad) ? $totalII4 : '' ; ?>
                </td>
            </tr>

            <tr style="<?php echo ($good) ? 'background-color:green;': ''; ?>">
                <td></td>
                <td class="font-weight-bold">២. សាលាអនុវត្តការគ្រប់គ្រងហិរញ្ញវត្ថុ មានប្រសិទ្ធភាពមធ្យម</td>
                <td colspan="<?php echo ($good) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($good) ? $totalII4 : '' ; ?>
                </td>
            </tr>

            <tr style="<?php echo ($best) ? 'background-color:green;': ''; ?>">
                <td></td>
                <td class="font-weight-bold">៣. សាលាអនុវត្តការគ្រប់គ្រងហិរញ្ញវត្ថុ មានប្រសិទ្ធភាពល្អ</td>
                <td colspan="<?php echo ($best) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($best) ? $totalII4 : '' ; ?>
                </td>
            </tr>

            <?php $grandTotal1 = $totalI1 + $totalII1; ?>
            <?php $grandTotal2 = $totalI2 + $totalII2; ?>
            <?php $grandTotal3 = $totalI3 + $totalII3; ?>
            <?php $grandTotal4 = $totalI4 + $totalII4; ?>
            <tr style="background-color:yellow;">
                <td colspan="2" class="text-center font-weight-bold">ពិន្ទុសរុប I+II</td>
                <td class="text-center">{{ $grandTotal1 }}</td>
                <td class="text-center">{{ $grandTotal2 }}</td>
                <td class="text-center">{{ $grandTotal3 }}</td>
                <td class="text-center">{{ $grandTotal4 }}</td>
            </tr>

            <?php $bad = ($grandTotal4 >= 1 && $grandTotal4 <= 123) ? true : false ; ?>
            <?php $good = ($grandTotal4 >= 124 && $grandTotal4 <= 172) ? true : false ; ?>
            <?php $best = ($grandTotal4 >= 173 && $grandTotal4 <= 246) ? true : false ; ?>

            <tr style="<?php echo ($bad) ? 'background-color:green;': ''; ?>">
                <td>លទ្ធផលរួម៖</td>
                <td class="font-weight-bold">១. សាលាអនុវត្តការគ្រប់គ្រងហិរញ្ញវត្ថុ គ្មានប្រសិទ្ធភាព</td>
                <td colspan="<?php echo ($bad) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($bad) ? $grandTotal4 : '' ; ?>
                </td>
            </tr>

            <tr style="<?php echo ($good) ? 'background-color:green;': ''; ?>">
                <td></td>
                <td class="font-weight-bold">២. សាលាអនុវត្តការគ្រប់គ្រងហិរញ្ញវត្ថុ មានប្រសិទ្ធភាពមធ្យម</td>
                <td colspan="<?php echo ($good) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($good) ? $grandTotal4 : '' ; ?>
                </td>
            </tr>

            <tr style="<?php echo ($best) ? 'background-color:green;': ''; ?>">
                <td></td>
                <td class="font-weight-bold">៣. សាលាអនុវត្តការគ្រប់គ្រងហិរញ្ញវត្ថុ មានប្រសិទ្ធភាពល្អ</td>
                <td colspan="<?php echo ($best) ? '4' : '5'; ?>" class="text-center">
                    <?php echo ($best) ? $grandTotal4 : '' ; ?>
                </td>
            </tr>

        </tbody>
    </table>
</div>