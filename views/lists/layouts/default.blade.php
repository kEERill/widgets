@push ('styles')
    {!! $widget->styles() !!}
@endpush

<table class="uk-table uk-table-striped">
    <thead>
        @include('widgets::lists.head', ['widget' => $widget])
    </thead>
    <tbody>
        @include('widgets::lists.rows', ['widget' => $widget])
    </tbody>
</table>

<div class="uk-grid uk-flex-middle uk-child-width-expand@m uk-grid-collapse" uk-grid>
    <div class="uk-width-auto" style="padding-right: 30px;">
        {!! $widget->getRecords()->render() !!}
    </div>
    <div class="uk-text-muted">
       Отображено записей: {{ $widget->getRecords()->firstItem() }} - {{ $widget->getRecords()->lastItem() }} из {{ $widget->getRecords()->total() }}
    </div>
</div>

<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 class="uk-modal-title">Настройки вывода</h2>
        <p>
            Когда нибудь тут будет форма, для выбора количество записей на страницы
        </p>
    </div>
</div>

@push ('scripts')
    {!! $widget->scripts() !!}
@endpush