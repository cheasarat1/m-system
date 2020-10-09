<table class="table table-striped">
    <thead>
        <tr>
            <th>ល.រ</th>
            <th class="text-center">បរិយាយ</th>
            <th class="text-center">មតិ និង ការឆ្លើយតប</th>
        </tr>
    </thead>
    <tbody class="report">

        <tr style="background-color:#03A9F4;">
            <td class="text-center">I</td>
            <td>វឌ្ឍនភាព</td>
            <td class="text-center"></td>
        </tr>

        <tr style="background-color:yellow;">
            <td class="text-right">ក</td>
            <td>ប្រសិទ្ធភាព និងស័ក្កសិទ្ធិភាពនៃការអនុវត្តថវិកា</td>
            <td class="text-center"></td>
        </tr>

        <?php $index = 1; ?>
        @foreach($sectionI as $one)
            <?php if (!empty($one->score1) && !empty($one->score2)): ?>
                <tr>
                    <td class="text-right">{{ $index++ }}</td>
                    <td>{{ substr($one->name, stripos($one->name, ' ')) }}</td>
                    <td class="text-center"></td>
                </tr>
            <?php endif ?>
        @endforeach

        <?php if ($index == 1): ?>
            <tr>
                <td></td>
                <td>មិនមាន</td>
                <td></td>
            </tr>
        <?php endif ?>

        <tr style="background-color:yellow;">
            <td class="text-right">ខ</td>
            <td>សាលារៀនមានសមត្ថភាពរៀបចំផែនការ និងថវិកាផ្អែកលើលទ្ធផល</td>
            <td class="text-center"></td>
        </tr>

        <?php $index = 1; ?>
        @foreach($sectionII as $two)
            <?php if (!empty($two->score1) && !empty($two->score2)): ?>
                <tr>
                    <td class="text-right">{{ $index++ }}</td>
                    <td>{{ substr($two->name, stripos($two->name, ' ')) }}</td>
                    <td class="text-center"></td>
                </tr>
            <?php endif ?>
        @endforeach

        <?php if ($index == 1): ?>
            <tr>
                <td></td>
                <td>មិនមាន</td>
                <td></td>
            </tr>
        <?php endif ?>

        <tr style="background-color:#03A9F4;">
            <td class="text-center">II</td>
            <td>បញ្ហាប្រឈម</td>
            <td class="text-center"></td>
        </tr>

        <tr style="background-color:yellow;">
            <td class="text-right">ក</td>
            <td>ប្រសិទ្ធភាព និងស័ក្កសិទ្ធិភាពនៃការអនុវត្តថវិកា</td>
            <td class="text-center"></td>
        </tr>

        <?php $index = 1; ?>
        @foreach($sectionI as $one)
            <?php if (empty($one->score2) && empty($one->score3)): ?>
                <tr>
                    <td class="text-right">{{ $index++ }}</td>
                    <td>{{ substr($one->name, stripos($one->name, ' ')) }}</td>
                    <td class="text-center"></td>
                </tr>
            <?php endif ?>
        @endforeach

        <?php if ($index == 1): ?>
            <tr>
                <td></td>
                <td>មិនមាន</td>
                <td></td>
            </tr>
        <?php endif ?>

        <tr style="background-color:yellow;">
            <td class="text-right">ខ</td>
            <td>សាលារៀនមានសមត្ថភាពរៀបចំផែនការ និងថវិកាផ្អែកលើលទ្ធផល</td>
            <td class="text-center"></td>
        </tr>

        <?php $index = 1; ?>
        @foreach($sectionII as $two)
            <?php if (empty($two->score2) && empty($two->score3)): ?>
                <tr>
                    <td class="text-right">{{ $index++ }}</td>
                    <td>{{ substr($two->name, stripos($two->name, ' ')) }}</td>
                    <td class="text-center"></td>
                </tr>
            <?php endif ?>
        @endforeach

        <?php if ($index == 1): ?>
            <tr>
                <td></td>
                <td>មិនមាន</td>
                <td></td>
            </tr>
        <?php endif ?>

        <tr class="">
            <td class="text-center">III</td>
            <td>ចំណុចបានណែនាំបន្ថែម</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><textarea rows="2" class="form-control"></textarea></td>
            <td></td>
        </tr>
        <tr class="">
            <td class="text-center">IV</td>
            <td>អនុសាសន៍</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><textarea rows="2" class="form-control"></textarea></td>
            <td></td>
        </tr>
    </tbody>
</table>