import app from 'flarum/admin/app';

app.initializers.add('preservemygames-maintenance', () => {
  const ext = app.extensionData.for('preservemygames-maintenance');
  const t = (key) => app.translator.trans(`preservemygames-maintenance.admin.settings.${key}`);

  ext
    .registerSetting(
      {
        setting: 'preservemygames-maintenance.mode',
        type: 'select',
        label: t('mode_label'),
        help: t('mode_help'),
        options: {
          off: t('mode_options.off'),
          banner: t('mode_options.banner'),
          read_only: t('mode_options.read_only'),
          closed: t('mode_options.closed'),
        },
      },
      100
    )
    .registerSetting(
      {
        setting: 'preservemygames-maintenance.title',
        type: 'text',
        label: t('title_label'),
        help: t('title_help'),
      },
      90
    )
    .registerSetting(
      {
        setting: 'preservemygames-maintenance.message',
        type: 'textarea',
        label: t('message_label'),
        help: t('message_help'),
      },
      80
    )
    .registerSetting(
      {
        setting: 'preservemygames-maintenance.allow_login',
        type: 'boolean',
        label: t('allow_login_label'),
        help: t('allow_login_help'),
      },
      70
    )
    .registerSetting(
      {
        setting: 'preservemygames-maintenance.show_banner',
        type: 'boolean',
        label: t('show_banner_label'),
        help: t('show_banner_help'),
      },
      60
    );
});
