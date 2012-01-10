<?php use_helper('I18N') ?>

<form method="post" action="<?php echo url_for('@action_edit?id=' . $action->id) ?>">
    <fieldset>
        <div class="clearfix">
            <label><?php echo __('Name') ?></label>
            <div class="input">
                <input name="name" class="large" type="text" value="<?php echo $action->name ?>" />
            </div>
        </div>
        <div class="clearfix">
            <label><?php echo __('Date') ?></label>
            <div class="input">
                <input name="date" class="span2 datepicker" type="text" value="<?php echo $action->date ?>" />
                <span class="help-inline">YYYY-MM-DD (e.g. 2011-12-30)</span>
            </div>
        </div>
        <div class="clearfix">
            <label><?php echo __('Deposit') ?></label>
            <div class="input">
                <input name="deposit" class="span2" type="text" value="<?php echo $action->deposit ?>" />
                <span class="help-inline"><?php echo __('Use a period "." for decimal separator') ?></span>
            </div>
        </div>
        <div class="clearfix">
            <label><?php echo __('Withdrawal') ?></label>
            <div class="input">
                <input name="withdrawal" class="span2" type="text" value="<?php echo $action->withdrawal ?>" />
                <span class="help-inline"><?php echo __('Use a period "." for decimal separator') ?></span>
            </div>
        </div>
        <div class="clearfix">
            <label><?php echo __('Tags') ?></label>
            <div class="input">
                <input name="tags" class="span5" type="text" value="<?php echo $tags ?>" />
                <span class="help-inline"><?php echo __('Use the comma as delimeter (e.g. Home, Rent, Athens)') ?></span>
            </div>
        </div>
        <div class="clearfix">
            <input name="submit" class="btn primary" type="submit" value="<?php echo __('Update') ?>" />
        </div>
    </fieldset>
</form>
