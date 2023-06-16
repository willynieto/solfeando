@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            <!-- [ Logo ] Start -->
            <div class="d-flex justify-content-center align-items-center">
                <div class="ui-w-60">
                    <div class="w-100 position-relative">
                        <img src={{ \Config::get('app.LOGO_PLANTILLA') }} alt="Brand Logo" class="img-fluid">
                    </div>
                </div>
            </div>
        </a>
    </td>
</tr>
