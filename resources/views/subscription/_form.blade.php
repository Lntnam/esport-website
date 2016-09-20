<div class="col-lg-6">
    <form role="form" method="post" action="{!! URL::route('subscription.create') !!}">
        {{ csrf_field() }}
        <input type="hidden" name="interests[{{ $interest }}]" value="1">
        <div class="form-group">
            <label for="email">@lang('contents.your_email')</label>
            <input type="email" value="" name="email" class="form-control" id="email">
        </div>
        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;" aria-hidden="true">
            <input type="text" name="b_59a9a5aee257480d4f3cbe81e_f848ac684f" tabindex="-1" value="">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success"><i class="fa fa-envelope-o" aria-hidden="true"></i> @lang('contents.btn_subscribe')</button>
        </div>
    </form>
</div>
