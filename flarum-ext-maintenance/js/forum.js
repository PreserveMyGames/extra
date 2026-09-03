import app from 'flarum/forum/app';
import applyMaintenanceUi from './src/forum/applyMaintenanceUi';

app.initializers.add('preservemygames-maintenance', () => {
  applyMaintenanceUi();
});
