@extends('layouts.back')

@section('title', trans('pages.update', ['model'=>'match']))

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.css"/>
@stop

@section('page-heading', trans('pages.update', ['model'=>'match']))

@section('page-sub-heading')
    @if (!empty($model))
        {{ $model['formatted_schedule'] }}
    @endif
@stop

@section('breadcrumbs', Breadcrumbs::render('update_match', $model))

@section('content')
    <!-- Add opponent modal -->
    <div class="modal fade" id="modalOpponent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="myModalLabel">@lang('contents.modal-add-title', ['model'=>'opponent'])</h4>
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <form role="form" method="post" action="{!! URL::route('back.match.doUpdate') !!}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{!! $model['id'] !!}">
                <div class="form-group">
                    <label for="opponent_id">@lang('contents.match-opponent')</label>
                    <div class="input-group" id="groupOpponent">
                        {!! Form::select('opponent_id',
                            $opponents,
                            !empty($model) ? $model['opponent_id'] : null,
                            ['placeholder'=>trans('contents.match-opponent-default'), 'id'=>'opponent'])
                        !!}
                    </div>
                </div>

                <div class="form-group">
                    <label for="games">@lang('contents.match-best-of')</label>
                    {!! Form::select('games', [1=>1, 2=>2, 3=>3, 5=>5, 7=>7], !empty($model) ? $model['games'] : 1, ['class'=>'form-control']) !!}

                </div>

                <div class="form-group">
                    <label for="result">@lang('contents.match-result')</label>
                    <div class="input-group">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="for"
                                   placeholder="@lang('contents.match-for-holder')"
                                   value="{{ !empty($model) ? $model['for'] : '' }}"/>
                        </div>
                        <div class="col-md-1">
                            <span class="glyphicon glyphicon-minus" style="margin-top: 8px;"></span>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="against"
                                   placeholder="@lang('contents.match-against-holder')"
                                   value="{{ !empty($model) ? $model['against'] : '' }}"/>
                        </div>
                    </div>
                </div>

                <div class="checkbox">
                    <label>
                        <input type="hidden" name="over" value="0">
                        <input type="checkbox" name="over" value="1" {{ !empty($model) ? ($model['over'] ? 'checked="checked"' : '' ) : '' }}>
                        @lang('contents.match-over')</label>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">@lang('contents.btn-submit')</button>
                    <button type="reset" class="btn btn-default">@lang('contents.btn-reset')</button>
                    <button type="button" class="btn btn-link">@lang('contents.btn-back')</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{!! URL::asset('js/combobox.js') !!}"></script>

    <script type="text/javascript">
        $('.btn-link').click(function() {window.location.href = '{{ route('back.match.index') }}'});

        $('#opponent').combobox({
            showAllItems: '@lang('contents.btn-combo-show-all')',
            didNotMatch: "@lang('contents.combo-did-not-match')",
            ifInvalid: function (value) {
                $('#modalOpponent').find('.btn-primary').hide();
                $('#modalOpponent').modal();
                $('#modalOpponent').on('hide.bs.modal', function () {
                    // clear selection if form close without adding any new item
                    if ($('#opponent').val() === null || $('#opponent').val() === '') {
                        $('#groupOpponent > input').val('');
                    }
                });

                $('#modalOpponent').find('.modal-body').load('{!! URL::route('back.opponent.ajaxCreate') !!}', function () {
                    // Set default name
                    $('#modalOpponent').find('#nameInput').val(value);

                    // Assign submit event
                    $('#modalOpponent').find('.btn-primary').off('click');
                    $('#modalOpponent').find('.btn-primary').on('click', function (e) {
                        $.post('{!! URL::route('back.opponent.ajaxCreate') !!}', // URL
                                $('#modalOpponent').find('.modal-body').find('form').serialize() // data
                        ).done(function (data) { // complete handler
                            if (data.success) {
                                // Add new item to list & select it too
                                $('#opponent').prepend($('<option>', {
                                    value: data.content.id,
                                    text: data.content.name,
                                    selected: true
                                }));

                                $('#modalOpponent').modal('hide');
                            }
                            else {
                                $('#modalOpponent').find('.modal-body').html(data.content);
                            }
                        })
                        ;
                    });

                    // Bind enter key
                    $('#modalOpponent').find('.modal-body').find('form').off('keypress');
                    $('#modalOpponent').find('.modal-body').find('form').keypress(function (e) {
                        if (e.which == 13) {
                            $('#modalOpponent').find('.btn-primary').click();
                        }
                    });

                    // Show button after the form is fully loaded
                    $('#modalOpponent').find('.btn-primary').show();
                });
                return true;
            }
        });
    </script>
@stop