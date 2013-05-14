  <h2>Storage</h2>
  <table class='table'>
    <thead>
      <th><span class='color'>Device</span></th>
      <th><span class='color'>Size</span></th>
      <th><span class='color'>Used</span></th>
      <th><span class='color'>Available</span></th>
      <th><span class='color'>Usage</span></th>
      <th><span class='color'>Mountpoint</span></th>
      {{@StorageUnmountColumn}}
    </thead>
    {{@StorageTableRows}}
  </table>