import app from 'flarum/forum/app';
import Component from 'flarum/common/Component';

export default class MaintenanceBanner extends Component {
  view() {
    const title = app.forum.attribute('preservemygamesMaintenanceTitle');
    const message = app.forum.attribute('preservemygamesMaintenanceMessage');
    const mode = app.forum.attribute('preservemygamesMaintenanceMode');
    const readOnlyHint =
      mode === 'read_only'
        ? ' ' + app.translator.trans('preservemygames-maintenance.forum.read_only_hint')
        : '';

    return (
      <div className="PmgMaintenanceBanner" role="status">
        <span className="PmgMaintenanceBanner-title">{title}</span>
        <span className="PmgMaintenanceBanner-message">
          {message}
          {readOnlyHint}
        </span>
      </div>
    );
  }
}
