import app from 'flarum/admin/app';

app.initializers.add('preservemygames-lxmf', () => {
  const ext = app.extensionData.for('preservemygames-lxmf');
  const t = (key) => app.translator.trans(`preservemygames-lxmf.admin.settings.${key}`);

  ext
    .registerSetting(
      {
        setting: 'preservemygames-lxmf.no_email_registration',
        type: 'boolean',
        label: t('no_email_registration_label'),
        help: t('no_email_registration_help'),
      },
      100
    )
    .registerSetting(
      {
        setting: 'preservemygames-lxmf.email_domain',
        type: 'text',
        label: t('email_domain_label'),
        help: t('email_domain_help'),
      },
      90
    );
});
