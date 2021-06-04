import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PageNotFoundComponent } from './core/page-not-found/page-not-found.component';
import { IndexComponent } from './home/index/index.component';


const routes: Routes = [
  { path: '', component: IndexComponent, redirectTo: '', pathMatch: 'full' },
  { path: '**', component: PageNotFoundComponent },

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule {}
