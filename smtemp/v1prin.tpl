<br>
<br>
						<table align=center>
						<tr>
<td colspan=2>
ЧСИ {$SERIAL} {$SHNAME}
<br>
РЕГИСТРАЦИЯ НА НАБЛЮДАТЕЛ
<br>
<b>{$V1POST.name}</b>
<br> &nbsp;
						<tr>
<td> входно име
<td> <b><u>{$V1POST.username}</u></b>
						<tr>
<td> входна парола
<td> <b><u>{$V1POST.password}</u></b>
						<tr>
<td> крайна дата
<td> <b>{$V1POST.expiration|date_format:"%d.%m.%Y"}</b>
						<tr>
<td> email
<td> <b>{$V1POST.email}</b>
						</table>
