<?php 
function template_administrador_confirmar_email($email, $senha,$admin_nome,$admin_criou_conta,$hash_confirmacao_email){ 

	return '<div style="text-align: center; max-width: 500px; margin:auto; border: 2px solid #ccc; padding-bottom: 25px; font-family: "Times New Roman", Times, serif; display:flex;flex-direction=row;justify-content-center;align-items-center;">
				<div style="width: 220px; height:90px; backgrond-color #242644; text-align-center;">
					<img src="'.BASE_IMAGES_SYSTEM_URL.SITE_LOGO.'" style="width: 200px; height:80px; margin:0px;padding:0px;"> 
				</div>
				<hr>
				<p style="padding:0px; margin:5px;">Olá '.$admin_nome.'</p>
				<p style="padding:0px; margin:5px;">Sua conta de administrador foi criada.</p>
				<p style="padding:0px; margin:5px;">Informações de acesso.</p>
				<hr>
				<p style="padding:0px; margin:5px;">Email: '.$email.'</p>
				<p style="padding:0px; margin:5px;">Senha: '.$senha.'</p>
				<hr>
				<p style="padding:0px; margin:5px;">Criada Pelo Administrador: '.$admin_criou_conta.'</p>
				<p style="padding:0px; margin:5px;">Confirme o seu email.</p>
				<p style="padding:0px; margin:5px;"><a href="'.BASE_ADMIN.'confirmacao-email/'.$hash_confirmacao_email.'" style="text-decoration:none;" target="_blank">Confirmar Email</a></p>
				<hr>
				<h4 style="padding:0px; margin:5px;">'.SITE_NOME.'</h4>
				<p style="padding:0px; margin:5px;">Data: '.date("d/m/Y H:i:s").'</p>
			</div>';

} 

function template_revendedor_criacao_conta($revendedor_nome,$revendedor_email,$revendedor_senha){  

	return '<div style="text-align: center; max-width: 500px; margin:auto; border: 2px solid #ccc; padding-bottom: 25px; font-family: "Times New Roman", Times, serif; display:flex;flex-direction=row;justify-content-center;align-items-center;">
				<div style="width: 220px; height:90px; backgrond-color #242644; text-align-center;">
					<img src="'.BASE_IMAGES_SYSTEM_URL.SITE_LOGO.'" style="width: 200px; height:80px; margin:0px;padding:0px;"> 
				</div>
				<hr>
				<p style="padding:0px; margin:5px;">Olá '.$revendedor_nome.'</p>
				<p style="padding:0px; margin:5px;">Sua conta de revendedor foi criada.</p>
				<p style="padding:0px; margin:5px;">Informações de acesso.</p>
				<hr>
				<p style="padding:0px; margin:5px;">Email: '.$revendedor_email.'</p>
				<p style="padding:0px; margin:5px;">Senha: '.$revendedor_senha.'</p>
				<hr>
				<p style="padding:0px; margin:5px;">Acesse a sua conta clicando no link abaixo.</p>
				<p style="padding:0px; margin:5px;"><a href="'.BASE_REVENDEDOR.'login" style="text-decoration:none;" target="_blank">Acessar área dos revendedores.</a></p>
				<hr>
				<h4 style="padding:0px; margin:5px;">'.SITE_NOME.'</h4>
				<p style="padding:0px; margin:5px;">Data: '.date("d/m/Y H:i:s").'</p>
			</div>';

} 

function template_administrador_recuperar_senha($admin_nome,$admin_hash_recuperar_senha,$admin_hash_recuperar_senha_expiracao){ 

	return '<div style="text-align: center; max-width: 500px; margin:auto; border: 2px solid #ccc; padding-bottom: 25px; font-family: "Times New Roman", Times, serif;display:flex;flex-direction=row;justify-content-center;align-items-center;">
				<div style="width: 220px; height:90px; backgrond-color #242644; text-align-center;">
					<img src="'.BASE_IMAGES_SYSTEM_URL.SITE_LOGO.'" style="width: 200px; height:80px; margin:0px;padding:0px;"> 
				</div>
				<hr>
				<p style="padding:0px; margin:5px;">Olá '.$admin_nome.'</p>
				<p style="padding:0px; margin:5px;">Você solicitou um link para recuperação de senha.</p>
				<p style="padding:0px; margin:5px;">Se não foi você quem solicitou, desconsiderar este email.</p>
				<hr>
				<p style="padding:0px; margin:5px;">O link expira em: '.date("d/m/Y", strtotime($admin_hash_recuperar_senha_expiracao)).' ás '.date("H:i:s", strtotime($admin_hash_recuperar_senha_expiracao)).'</p>
				<p style="padding:0px; margin:5px;">Link: <a href="'.BASE_ADMIN.'recuperar-senha-ps-2/'.$admin_hash_recuperar_senha.'" style="text-decoration:none;" target="_blank">Recuperar Senha</a></p>
				<hr>
				<h4 style="padding:0px; margin:5px;">'.SITE_NOME.'</h4>
				<p style="padding:0px; margin:5px;">Data: '.date("d/m/Y H:i:s").'</p>
			</div>';

}

function template_user_recuperar_senha($user_nome,$user_hash_recuperar_senha,$user_hash_recuperar_senha_expiracao){ 

	return '<div style="text-align: center; max-width: 500px; margin:auto; border: 2px solid #ccc; padding-bottom: 25px; font-family: "Times New Roman", Times, serif;display:flex;flex-direction=row;justify-content-center;align-items-center;">
				<div style="width: 220px; height:90px; backgrond-color #242644; text-align-center;">
					<img src="'.BASE_IMAGES_SYSTEM_URL.SITE_LOGO.'" style="width: 200px; height:80px; margin:0px;padding:0px;"> 
				</div>
				<hr>
				<p style="padding:0px; margin:5px;">Olá '.$user_nome.'</p>
				<p style="padding:0px; margin:5px;">Você solicitou um link para recuperação de senha.</p>
				<p style="padding:0px; margin:5px;">Se não foi você quem solicitou, desconsiderar este email.</p>
				<hr>
				<p style="padding:0px; margin:5px;">O link expira em: '.date("d/m/Y", strtotime($user_hash_recuperar_senha_expiracao)).' ás '.date("H:i:s", strtotime($user_hash_recuperar_senha_expiracao)).'</p>
				<p style="padding:0px; margin:5px;">Link: <a href="'.BASE_USER.'recuperar-senha-ps-2/'.$user_hash_recuperar_senha.'" style="text-decoration:none;" target="_blank">Alterar minha Senha</a></p>
				<hr>
				<h4 style="padding:0px; margin:5px;">'.SITE_NOME.'</h4>
				<p style="padding:0px; margin:5px;">Data: '.date("d/m/Y H:i:s").'</p>
			</div>';

}


function template_revendedor_recuperar_senha($revendedor_nome,$revendedor_hash_recuperar_senha,$revendedor_hash_recuperar_senha_expiracao){ 

	return '<div style="text-align: center; max-width: 500px; margin:auto; border: 2px solid #ccc; padding-bottom: 25px; font-family: "Times New Roman", Times, serif;display:flex;flex-direction=row;justify-content-center;align-items-center;">
				<div style="width: 220px; height:90px; backgrond-color #242644; text-align-center;">
					<img src="'.BASE_IMAGES_SYSTEM_URL.SITE_LOGO.'" style="width: 200px; height:80px; margin:0px;padding:0px;"> 
				</div>
				<hr>
				<p style="padding:0px; margin:5px;">Olá '.$revendedor_nome.'</p>
				<p style="padding:0px; margin:5px;">Você solicitou um link para recuperação de senha.</p>
				<p style="padding:0px; margin:5px;">Se não foi você quem solicitou, desconsiderar este email.</p>
				<hr>
				<p style="padding:0px; margin:5px;">O link expira em: '.date("d/m/Y", strtotime($revendedor_hash_recuperar_senha_expiracao)).' ás '.date("H:i:s", strtotime($revendedor_hash_recuperar_senha_expiracao)).'</p>
				<p style="padding:0px; margin:5px;">Link: <a href="'.BASE_REVENDEDOR.'recuperar-senha-ps-2/'.$revendedor_hash_recuperar_senha.'" style="text-decoration:none;" target="_blank">Alterar minha Senha</a></p>
				<hr>
				<h4 style="padding:0px; margin:5px;">'.SITE_NOME.'</h4>
				<p style="padding:0px; margin:5px;">Data: '.date("d/m/Y H:i:s").'</p>
			</div>';

}

function template_revendedor_adicionar_user($user_nome,$user_email,$user_senha, $msg_premium, $revendedor_nome){  

	return '<div style="text-align: center; max-width: 500px; margin:auto; border: 2px solid #ccc; padding-bottom: 25px; font-family: "Times New Roman", Times, serif; display:flex;flex-direction=row;justify-content-center;align-items-center;">
				<div style="width: 220px; height:90px; backgrond-color #242644; text-align-center;">
					<img src="'.BASE_IMAGES_SYSTEM_URL.SITE_LOGO.'" style="width: 200px; height:80px; margin:0px;padding:0px;"> 
				</div>
				<hr>
				<p style="padding:0px; margin:5px;">Olá '.$user_nome.'</p>
				<p style="padding:0px; margin:5px;">Sua conta foi criada.</p>
				<p style="padding:0px; margin:5px;">Informações de acesso.</p>
				<hr>
				<p style="padding:0px; margin:5px;">Email: '.$user_email.'</p>
				<p style="padding:0px; margin:5px;">Senha: '.$user_senha.'</p>
				<p style="padding:0px; margin:5px;">Plano Premium: '.$msg_premium.'</p>
				<p style="padding:0px; margin:5px;">Conta criada pelo revendedor: '.$revendedor_nome.'</p>
				<hr>
				<p style="padding:0px; margin:5px;">Acesse a sua conta clicando no link abaixo.</p>
				<p style="padding:0px; margin:5px;"><a href="'.BASE_USER.'login" style="text-decoration:none;" target="_blank">Acessar minha conta.</a></p>
				<hr>
				<h4 style="padding:0px; margin:5px;">'.SITE_NOME.'</h4>
				<p style="padding:0px; margin:5px;">Data: '.date("d/m/Y H:i:s").'</p>
			</div>';

} 
?>

