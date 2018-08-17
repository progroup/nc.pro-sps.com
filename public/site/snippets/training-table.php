<div role="tabpanel" class="tabpanel clearfix">
	
	<a href="http://ncpreventiontta.skyprepapp.com/" target="_new" class="ecco-login btn btn-primary" style="float: right;width: auto;margin-bottom:4px">Training Portal</a>
    
    <!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#training-calendar" aria-controls="state" role="tab" data-toggle="tab">Training Calendar</a></li>
        <li role="presentation"><a href="#state" aria-controls="state" role="tab" data-toggle="tab">State</a></li>
        <!-- <li role="presentation"><a href="#national" aria-controls="national" role="tab" data-toggle="tab">National</a></li> -->
        <li role="presentation"><a href="#online" aria-controls="online" role="tab" data-toggle="tab">Online</a></li>
    </ul>
    

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="training-calendar">
            <div data-tockify-component="calendar" data-tockify-calendar="nctta"></div>
            <script data-cfasync="false" data-tockify-script="embed" src="https://public.tockify.com/browser/embed.js"></script>
        </div>
        <?php $index = 0 ?>
        <?php foreach($page->children() as $subpage) : ?>
        <?php // echo ($index == 0) ? 'active' : '' ?>
            <div role="tabpanel" class="tab-pane" id="<?php echo $subpage->uid() ?>">
                <?php foreach($subpage->trainings()->toStructure() as $training) : ?>
                    <table class="training-table">
                        <caption></caption>
                        <thead>
                            <tr>
                                <th class="training-table-date">Dates</th>
                                <th class="training-table-training" colspan="2">Training</th>
                                <th class="training-table-modality">Modality</th>
                                <th class="training-table-ceus">NCSAPPB Credit Hours</th>
                                <th class="training-table-archived">Archived</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $training->dates()->html() ?>
                                </td>
                                <td colspan="2">
                                    <?php echo $training->training()->html() ?>
                                </td>
                                <td>
                                    <?php echo $training->modality()->html() ?>
                                </td>
                                <td class="training-table-ceus">
                                    <?php
                                        if ($training->ceus()) {
                                            echo "Yes";
                                        } else {
                                            echo "N/A";
                                        }

                                    ?>
                                </td>
                                <td class="training-table-archived">
                                    <?php echo ucfirst(strtolower($training->archived())); ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6">
                                    <p>
                                        <b>Description:</b>
                                        <br>
                                        <?php echo $training->description()->kirbytext() ?>
                                    </p>
                                    <p>
                                        <b>Logistics</b>
                                        <br>
                                        <?php echo $training->logistics()->kirbytext() ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endforeach ?>
            </div>
            <?php $index++ ?>
        <?php endforeach ?>
    </div>
</div>
