        <h2>System Information</h2>
	  <table class="table">
	    <thead>
	      <th><span class="color">Property</span></th>
	      <th><span class="color">Value</span></th>
	    </thead>
	    <tr>
	      <td>Kernel version:</td>
	      <td id="dashboard-kernel">{{@SystemKernel}}</td>
	    </tr>
	    <tr>
	      <td>Uptime:</td>
	      <td id="dashboard-uptime">{{@SystemUptime}}</td>
	    </tr>
	    <tr>
	      <td>Hostname:</td>
	      <td>{{@SystemHostname}}</td>
	    </tr>
	    <tr>
	      <td>Architecture:</td>
	      <td>{{@SystemArchitecture}}</td>
	    </tr>
	    <tr>
	      <td>Operating system:</td>
	      <td>{{@SystemOS}}</td>
	    </tr>
	    <tr>
	      <td>System load:</td>
	      <td id="dashboard-load">{{@SystemLoad}}</td>
	    </tr>
	    <tr>
              <td>System temperature:</td>
              <td id="dashboard-temperature">{{@SystemTemperature}}</td>
            </tr>
	  </table>