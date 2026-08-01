import app from 'flarum/admin/app';

app.initializers.add('preservemygames-altcha', () => {
  const ext = app.extensionData.for('preservemygames-altcha');
  const t = (key) => app.translator.trans(`preservemygames-altcha.admin.settings.${key}`);

  ext
    .registerSetting(
      {
        setting: 'preservemygames-altcha.enabled',
        type: 'boolean',
        label: t('enabled_label'),
        help: t('enabled_help'),
      },
      100
    )
    .registerSetting(
      {
        setting: 'preservemygames-altcha.hmac_secret',
        type: 'text',
        label: t('hmac_secret_label'),
        help: t('hmac_secret_help'),
      },
      95
    )
    .registerSetting(
      {
        setting: 'preservemygames-altcha.cost',
        type: 'number',
        label: t('cost_label'),
        help: t('cost_help'),
      },
      90
    )
    .registerSetting(
      {
        setting: 'preservemygames-altcha.protect_registration',
        type: 'boolean',
        label: t('protect_registration_label'),
      },
      85
    )
    .registerSetting(
      {
        setting: 'preservemygames-altcha.protect_login',
        type: 'boolean',
        label: t('protect_login_label'),
      },
      80
    )
    .registerSetting(
      {
        setting: 'preservemygames-altcha.protect_password_reset',
        type: 'boolean',
        label: t('protect_password_reset_label'),
      },
      75
    )
    .registerSetting(
      {
        setting: 'preservemygames-altcha.protect_discussion',
        type: 'boolean',
        label: t('protect_discussion_label'),
      },
      70
    )
    .registerSetting(
      {
        setting: 'preservemygames-altcha.protect_reply',
        type: 'boolean',
        label: t('protect_reply_label'),
      },
      65
    );
});
