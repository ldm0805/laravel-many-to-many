<!DOCTYPE html>
<html>
<head>
	<title>Nuovo post inserito</title>
</head>
<body>
	<div style="background-color: #F0F4F8; padding: 20px;">
		<h1 style="color: #2E3A48; font-size: 28px; font-family: Arial, sans-serif;">Nuovo post inserito</h1>
		<hr style="border: none; border-top: 2px solid #C9D5E2; margin: 20px 0;">
		<p style="color: #2E3A48; font-size: 16px; font-family: Arial, sans-serif;">
			Nuovo post inserito con i seguenti dettagli:
		</p>
		<ul style="color: #2E3A48; font-size: 16px; font-family: Arial, sans-serif; list-style: none; padding: 0; margin: 0;">
			<li style="margin-bottom: 10px;">
				<strong>Titolo:</strong> {{$lead->title}}
			</li>
			<li style="margin-bottom: 10px;">
				<strong>Slug:</strong> {{$lead->slug}}
			</li>
			<li style="margin-bottom: 10px;">
				<strong>Contenuto:</strong> {{$lead->content}}
			</li>
		</ul>
		<p style="color: #2E3A48; font-size: 16px; font-family: Arial, sans-serif;">
			Per ulteriori dettagli, si prega di accedere alla piattaforma.
		</p>
	</div>
</body>
</html>
