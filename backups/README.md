# Backups do Site ADE Sampa 2025

Esta pasta armazena as cópias de segurança geradas localmente e baixadas do servidor KingHost (`http://oranilom.com.br`).

## Conteúdo dos Backups

1. **`backup_tema_ade_sampa_v2.1.3_*.zip`**:
   - Código-fonte completo do tema, assets em SVG de alta fidelidade do Figma, estilos CSS e scripts PHP.
2. **`backup_banco_dados_oranilom_*.zip`**:
   - Dump SQL completo de todas as tabelas do WordPress (`wp_*`).
   - Cópia segura das chaves e constantes de `wp-config.php`.
   - Manifesto descritivo `backup_info.json`.

## Como Gerar um Novo Backup
Execute no PowerShell:
```powershell
.\fazer-backup.ps1
```
Ou acesse no navegador:
`http://oranilom.com.br/backup-site.php?key=ade_sampa_super_secret_2025`
