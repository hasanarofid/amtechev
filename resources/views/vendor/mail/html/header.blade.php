@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="vertical-align: middle;">
                <img src="{{ config('app.url') }}/logo.png" class="logo" alt="Amtech EV Logo" style="height: 50px; width: auto; display: block;">
            </td>
            <td style="vertical-align: middle; padding-left: 10px;">
                <span style="font-size: 24px; font-weight: 900; color: #18181b; text-transform: uppercase; font-family: sans-serif;">AMTECH <span style="color: #00df81; font-style: italic;">EV</span></span>
            </td>
        </tr>
    </table>
</a>
</td>
</tr>
