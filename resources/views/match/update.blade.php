@extends('layouts.back')

@section('title', 'Update ' . Setting::getMasterListValue('back_games', $game) . ' Match')

@section('head')
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('css/jquery-ui.min.css') }}"/>
@stop

@section('page-heading', 'Update ' . Setting::getMasterListValue('back_games', $game) . ' Match')

@section('page-sub-heading', ' vs ' . (!empty($model->opponent) ? $model->opponent->name : 'TBD' ))

@section('content')
    <!-- Add tournament modal -->
    <div class="modal fade" id="modalTournament" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="myModalLabel">Create {{ Setting::getMasterListValue('back_games', $game) }} Tournament</h4>
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

    <!-- Add opponent modal -->
    <div class="modal fade" id="modalOpponent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"
                        id="myModalLabel">Create {{ Setting::getMasterListValue('back_games', $game) }} Opponent</h4>
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
            <form role="form" method="post" action="{!! route('back.fixtures.doUpdate') !!}">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{!! $model['id'] !!}">

                @include('match._form')
            </form>
        </div>
    </div>
@stop

@section('foot')
    <script type="text/javascript" src="{{ URL::asset('js/moment-with-locales.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{!! URL::asset('js/combobox.js') !!}"></script>

    <script type="text/javascript">
        $('#schedulepicker').datetimepicker({
            format: '{{ config('settings.match_picker_format') }}',
            stepping: 5,
            // minDate: moment().startOf('day'),
            locale: '{{ App::getLocale() }}',
            collapse: false,
            sideBySide: true,
            showTodayButton: true
        });
        var modal = $('#modalTournament');
        var tournament = $('#tournament');

        tournament.combobox({
            ifInvalid: function (value) {
                modal.find('.btn-primary').hide();
                modal.modal();
                modal.on('hide.bs.modal', function () {
                    // clear selection if form close without adding any new item
                    if (tournament.val() === null || tournament.val() === '') {
                        $('#groupTournament > input').val('');
                    }
                });

                modal.find('.modal-body').load('{!! route('back.tournaments.ajaxCreate', ['game' => $game]) !!}', function () {
                    // Set default name
                    modal.find('#nameInput').val(value);

                    // Assign submit event
                    modal.find('.btn-primary').off('click');
                    modal.find('.btn-primary').on('click', function () {
                        $.post('{!! route('back.tournaments.ajaxCreate', ['game' => $game]) !!}', // URL
                                modal.find('.modal-body').find('form').serialize() // data
                        ).done(function (data) { // complete handler
                            if (data.success) {
                                // Add new item to list & select it too
                                tournament.prepend($('<option>', {
                                    value: data.content.id,
                                    text: data.content.name,
                                    selected: true
                                }));

                                modal.modal('hide');
                            }
                            else {
                                modal.find('.modal-body').html(data.content);
                            }
                        })
                        ;
                    });

                    // Bind enter key
                    modal.find('.modal-body').find('form').off('keypress');
                    modal.find('.modal-body').find('form').keypress(function (e) {
                        if (e.which == 13) {
                            modal.find('.btn-primary').click();
                        }
                    });

                    // Show button after the form is fully loaded
                    modal.find('.btn-primary').show();
                });
                return true;
            }
        });

        var opponent = $('#opponent');
        modal = $('#modalOpponent');

        opponent.combobox({
            ifInvalid: function (value) {
                modal.find('.btn-primary').hide();
                modal.modal();
                modal.on('hide.bs.modal', function () {
                    // clear selection if form close without adding any new item
                    if (opponent.val() === null || opponent.val() === '') {
                        $('#groupOpponent > input').val('');
                    }
                });

                modal.find('.modal-body').load('{!! route('back.opponents.ajaxCreate', ['game' => $game]) !!}', function () {
                    // Set default name
                    modal.find('#nameInput').val(value);

                    // Assign submit event
                    modal.find('.btn-primary').off('click');
                    modal.find('.btn-primary').on('click', function () {
                        $.post('{!! route('back.opponents.ajaxCreate', ['game' => $game]) !!}', // URL
                                modal.find('.modal-body').find('form').serialize() // data
                        ).done(function (data) { // complete handler
                            if (data.success) {
                                // Add new item to list & select it too
                                opponent.prepend($('<option>', {
                                    value: data.content.id,
                                    text: data.content.name,
                                    selected: true
                                }));

                                modal.modal('hide');
                            }
                            else {
                                modal.find('.modal-body').html(data.content);
                            }
                        })
                        ;
                    });

                    // Bind enter key
                    modal.find('.modal-body').find('form').off('keypress');
                    modal.find('.modal-body').find('form').keypress(function (e) {
                        if (e.which == 13) {
                            modal.find('.btn-primary').click();
                        }
                    });

                    // Show button after the form is fully loaded
                    modal.find('.btn-primary').show();
                });
                return true;
            }
        });
    </script>
@stop
