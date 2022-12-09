<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html,body { padding: 0; margin:0; }
        th, td{
            padding-top: 7px;
            padding-bottom: 7px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .custom-button{
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
            border: 1px solid #7DE5ED;
            background-color: #7DE5ED;
            color: white;
            border-radius: 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:700px">
		<tbody>
			<tr>
				<td align="center" valign="center" style="text-align:center; padding: 40px">
					<a href="{{ url('') }}" rel="noopener" target="_blank">
                        <img alt="Logo" src="{{ asset($web_config['web_logo']) }}" onerror="this.src='{{ asset('/assets/images/icon.png') }}'" class="h-50px h-lg-55px" />
					</a>
				</td>
			</tr>
			<tr>
				<td align="left" valign="center">
					<div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
						<div style="text-align: center; margin-top: 20px">
                            <a href="{{ $url }}" style="padding-top: 10px;
                                padding-bottom: 10px;
                                padding-left: 20px;
                                padding-right: 20px;
                                border: 1px solid #7DE5ED;
                                background-color: #7DE5ED;
                                color: white;
                                border-radius: 10px;
                                text-decoration: none;">
                                Reset Password
                            </a>
                        </div>
                        <div style="text-align: center; margin-top: 20px">
                            Atau klik link dibawah ini untuk melakukan reset ulang password <br>
                            {{ $url }}
                        </div>
						<!--end:Email content-->
						<div style="padding-bottom: 10px">Kind regards,
						<br>PT.Mitra Global Kencana.
						<tr>
							<td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
								<p>PT.Mitra Global Kencana</p>
								<p>Copyright ©
								<a href="{{ url('') }}" rel="noopener" target="_blank">Dokgo</a>.</p>
							</td>
						</tr></br></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>

</body>
</html>
